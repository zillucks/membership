<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Traits\ActiveIdentifier;
use Carbon\Carbon;

class Member extends Model
{
    use ActiveIdentifier, SoftDeletes;

    protected $table = 'member';

    protected $casts = [
        'verified_at' => 'datetime',
    ];

    protected $appends = ['verification_status'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->member_code = strtoupper(Str::random(10));
            $model->referral_code = strtoupper(Str::random(10));
            $model->registration_date = Carbon::now()->toDateString();
            if ($model->is_verified) {
                $model->verified_at = Carbon::now();
            }
        });
    }

    public function scopeFilter($query, Request $request)
    {
        if ($request->has('registration_date') && !empty($request->get('registration_date'))) {
            $query->where('registration_date', $request->get('registration_date'));
        }
        if ($request->has('is_verified') && !empty($request->get('is_verified'))) {
            $query->where('is_verified', $request->get('is_verified'));
        }

        return $query;
    }

    public function getVerificationStatusAttribute()
    {
        $status = [
            0 => [
                'text_class' => 'text-danger',
                'row_class' => 'bg-danger',
                'label' => "<i class='fas fa-exclamation'></i> Belum Verifikasi",
            ],
            1 => [
                'text_class' => '',
                'row_class' => '',
                'label' => "<i class='fas fa-check'></i> Terverifikasi",
            ]
        ];

        return json_decode(json_encode($status[$this->is_verified]));
    }

    public function identity()
    {
        return $this->belongsTo('App\Models\Identity');
    }

    public function member_type()
    {
        return $this->belongsTo('App\Models\MemberType');
    }

    public function role()
    {
        return $this->belongsTo('App\Models\Role');
    }

    public function downlines()
    {
        return $this->hasMany('App\Models\Member', 'referral_id', 'id');
    }

    public function referral()
    {
        return $this->belongsTo('App\Models\Member', 'referral_id');
    }

    public function transactions()
    {
        return $this->hasMany('App\Models\PointTransaction');
    }
}
