<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PointTransactionDetail extends Model
{
    protected $table = 'point_transaction_detail';

    public function setPointEarnedAttribute($value)
    {
        $this->attributes['point_earned'] = empty($value) ? 0 : $value;
    }

    public function setPointRedeemAttribute($value)
    {
        $this->attributes['point_redeem'] = empty($value) ? 0 : $value;
    }

    public function transaction()
    {
        return $this->belongsTo('App\Models\PointTransaction', 'point_transaction_id');
    }
}
