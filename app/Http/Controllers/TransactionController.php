<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\PointTransaction AS Transaction;
use App\Models\PointTransactionDetail AS TransactionDetail;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Illuminate\Validation\Rule;

use Auth;
use Carbon\Carbon;
use Validator;

class TransactionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $transactions = Transaction::orderBy('invoice_date', 'desc')->paginate(15);
        $transactions->appends($request->query());

        return view('transactions.index', compact('transactions'));
    }

    public function create(Request $request)
    {
        $members = Member::with([
            'identity' => function ($identity) {
                $identity->orderBy('full_name', 'asc');
            }
        ])->get()->pluck('identity.full_name', 'id');
        $status = Transaction::getTransactionStatus();
        return view('transactions.create', compact(['members', 'status']));
    }

    public function store(Request $request, Transaction $transaction)
    {
        $validator = Validator::make(
            $request->input(),
            [
                'member_id' => 'required',
                'invoice_date' => 'required|date',
                'point_earned' => 'required_if:point_redeem,0',
                'point_redeem' => 'required_if:point_earned,0',
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)-withInput();
        }

        DB::beginTransaction();
        try {
            $transaction->member_id = $request->input('member_id');
            $transaction->invoice_date = $request->input('invoice_date');
            $transaction->description = $request->input('description');
            $transaction->transaction_status = $request->input('transaction_status');
            $transaction->user_log = Auth::user()->identity->full_name;
            $transaction->save();

            $detail = new TransactionDetail();
            $detail->point_earned = $request->input('point_earned');
            $detail->point_redeem = $request->input('point_redeem');
            $transaction->detail()->save($detail);

            if ($transaction->transaction_status == 'confirmed') {
                $point_total = (int)$request->input('point_earned') - (int)$request->input('point_redeem');
                $member = Member::find($transaction->member_id);
                $member->current_point += $point_total;
                $transaction->member()->associate($member);
                $transaction->save();
            }
            
            DB::commit();

            $request->session()->flash('success', [
                'title' => 'Sukses',
                'message' => 'Data Transaksi Berhasil disimpan'
            ]);

            return redirect()->route('admin.transactions');

        } catch (QueryException $e) {
            DB::rollback();
            $request->session()->flash('error', [
                'title' => "Error {$e->getCode()}",
                'message' => $e->getMessage()
            ]);
            return redirect()->back()->withInput();
        }
    }

    public function edit(Request $request, Transaction $transaction)
    {
        $members = Member::with([
            'identity' => function ($identity) {
                $identity->orderBy('full_name', 'asc');
            }
        ])->get()->pluck('identity.full_name', 'id');
        $status = Transaction::getTransactionStatus();

        return view('transactions.edit', compact(['transaction', 'members', 'status']));
    }

    public function update(Request $request, Transaction $transaction)
    {
        $validator = Validator::make(
            $request->input(),
            [
                'invoice_date' => 'required|date',
                'point_earned' => 'required_if:point_redeem,0',
                'point_redeem' => 'required_if:point_earned,0',
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();
        try {
            // $transaction->member_id = $request->input('member_id');
            $transaction->invoice_date = $request->input('invoice_date');
            $transaction->description = $request->input('description');
            $transaction->transaction_status = $request->input('transaction_status');
            $transaction->user_log = Auth::user()->identity->full_name;

            $detail = TransactionDetail::where('point_transaction_id', $transaction->id)->first();
            $detail->point_earned = $request->input('point_earned');
            $detail->point_redeem = $request->input('point_redeem');

            $point_total = 0;

            $member = Member::find($transaction->member_id);
            if ($transaction->getOriginal('transaction_status') == 'confirmed' && $transaction->transaction_status != 'confirmed') {
                $point_earned = $detail->getOriginal('point_earned');
                $point_redeem = $detail->getOriginal('point_redeem');
                $point_total = ($point_earned - $point_redeem)*-1;
            }

            if ($transaction->getOriginal('transaction_status') == 'confirmed' && $transaction->transaction_status == 'confirmed') {
                $old_point_earned = $detail->getOriginal('point_earned');
                $old_point_redeem = $detail->getOriginal('point_redeem');
                $old_point_total = $old_point_earned - $old_point_redeem;
                $new_point_earned = $detail->point_earned;
                $new_point_redeem = $detail->point_redeem;
                $point_total = ($new_point_earned - $old_point_earned) - ($new_point_redeem - $old_point_redeem);
            }

            if ($transaction->getOriginal('transaction_status') != 'confirmed' && $transaction->transaction_status == 'confirmed') {
                $point_total = $detail->point_earned - $detail->point_redeem;
            }

            $member->current_point += $point_total;

            $member->save();

            $transaction->detail()->save($detail);

            $transaction->save();
            
            DB::commit();

            $request->session()->flash('success', [
                'title' => 'Sukses',
                'message' => 'Data Transaksi Berhasil disimpan'
            ]);

            return redirect()->route('admin.transactions');
            
        } catch (QueryException $e) {
            DB::rollback();
            $request->session()->flash('error', [
                'title' => "Error {$e->getCode()}",
                'message' => $e->getMessage()
            ]);
            return redirect()->back();
        }
    }

    public function delete(Request $request, Transaction $transaction)
    {
        DB::beginTransaction();
        try {
            $member = Member::find($transaction->member_id);
            if ($transaction->transaction_status == 'confirmed') {
                $member->current_point -= ($transaction->detail->point_earned - $transaction->detail->point_redeem);
                $member->save();
            }

            $transaction->detail()->delete();
            $transaction->delete();

            DB::commit();

            $request->session()->flash('deleted', [
                'title' => "Sukses",
                'message' => "Data transaksi berhasil dihapus"
            ]);

            return response()->json($request);

        } catch (QueryException $e) {
            DB::rollback();

            $request->session()->flash('error', [
                'title' => "Error {$e->getCode()}",
                'message' => $e->getMEssage()
            ]);
            return redirect()->back();
        }
    }

}
