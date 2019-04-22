<?php

use Illuminate\Database\Seeder;
use App\Models\PointTransaction;

class PointTransactionDetailTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $transactions = PointTransaction::all();

        foreach ($transactions as $transaction) {
            $transaction->details()->saveMany(factory(App\Models\PointTransactionDetail::class, mt_rand(2, 12))->make());
        }
    }
}
