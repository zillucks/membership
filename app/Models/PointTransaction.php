<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PointTransaction extends Model
{
    use SoftDeletes;

    protected $table = 'point_transaction';
    protected $appends = ['total_point_earned', 'total_point_redeem'];
    
    public static function getTransactionStatus()
    {
        return [
            'process' => 'Proses',
            'confirmed' => 'Dikonfirmasi',
            'rejected' => 'Ditolak',
            'canceled' => 'Batal'
        ];
    }

    public function scopeFilter($query, Request $request)
    {
        if ($request->has('invoice_date') && !empty($request->get('invoice_date'))) {
            $query->where('invoice_date', $request->get('invoice_date'));
        }
        if ($request->has('transaction_status') && !empty($request->get('transaction_status'))) {
            $query->where('transaction_status', $request->get('transaction_status'));
        }

        return $query;
    }

    public function getTotalPointEarnedAttribute()
    {
        return $this->detail()->sum('point_earned');
    }

    public function getTotalPointRedeemAttribute()
    {
        return $this->detail()->sum('point_redeem');
    }

    public function getStatusIdentifier()
    {
        switch($this->transaction_status) {
            case 'process':
                return [
                    'text-class' => 'text-warning',
                    'row-class' => 'bg-warning',
                    'label' => "<div class='d-flex align-items-center justify-content-center'><div class='fas fa-fw fa-spinner'></div>&nbsp;<div class='d-none d-md-block'>On Process</div></div>",
                ];
            break;
            case 'confirmed':
                return [
                    'text-class' => 'text-success',
                    'row-class' => 'bg-success',
                    'label' => "<div class='d-flex align-items-center justify-content-center'><div class='fas fa-fw fa-check-circle'></div>&nbsp;<div class='d-none d-md-block'>Confirmed</div></div>",
                ];
            break;
            case 'rejected':
                return [
                    'text-class' => 'text-danger',
                    'row-class' => 'bg-danger',
                    'label' => "<div class='d-flex align-items-center justify-content-center'><div class='fas fa-fw fa-exclamation-circle'></div>&nbsp;<div class='d-none d-md-block'>Rejected</div></div>",
                ];
            break;
            case 'canceled':
                return [
                    'text-class' => 'text-muted',
                    'row-class' => 'bg-gray',
                    'label' => "<div class='d-flex align-items-center justify-content-center'><div class='fas fa-fw fa-minus-circle'></div>&nbsp;<div class='d-none d-md-block'>Canceled</div></div>",
                ];
            break;
        }
    }

    public function member()
    {
        return $this->belongsTo('App\Models\Member');
    }

    public function detail()
    {
        return $this->hasOne('App\Models\PointTransactionDetail', 'point_transaction_id');
    }

}
