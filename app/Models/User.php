<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
use App\Models\Member;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable, SoftDeletes;

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = ['verification_status'];

    protected static function boot()
    {
        parent::boot();

        static::updating(function ($model) {
            // $model->member_code = strtoupper(Str::random(10));
            // $model->referral_code = strtoupper(Str::random(10));
            // $model->registration_date = Carbon::now()->toDateString();
            // if ($model->is_verified) {
            //     $model->verified_at = Carbon::now();
            // }
            $member = Member::find(Auth::user()->member->id);
            $member->verified_at = Auth::user()->email_verified_at;
            $member->is_verified = !is_null(Auth::user()->email_verified_at);
            $member->save();
        });
    }

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::make($password);
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
                'text_class' => 'text-success',
                'row_class' => '',
                'label' => "<i class='fas fa-check'></i> Terverifikasi",
            ]
        ];

        return json_decode(json_encode($status[$this->isVerified()]));
    }

    public function isVerified()
    {
        return $this->email_verified_at != '';
    }

    public function currentRole()
    {
        if (!is_null($this->member)) {
            if (!is_null($this->member->role)) {
                return $this->member->role->slug;
            }
        }
        return 'guest';
    }

    public function isAdmin()
    {
        if (!is_null($this->member)) {
            if (!is_null($this->member->role)) {
                return $this->member->role->slug == 'administrator' || $this->member->role->slug == 'staff';
            }
            return false;
        }

        return false;
    }

    public function hasRole($roles)
    {
        if (is_array($roles)) {
            foreach ($roles as $role) {
                return $this->checkRole($role);
            }
        }
        else {
            return $this->checkRole($roles);
        }
    }

    public function checkRole($role)
    {
        if (!empty($this->member)) {
            return $this->member->role->slug == $role;
        }
        else {
            return 'guest';
        }
    }

    public function scopeFilter($query, Request $request)
    {
        if ($request->has('username') && !empty($request->get('username'))) {
            $query->where('username', $request->get('username'));
        }
        if ($request->has('email') && !empty($request->get('email'))) {
            $query->where('email', $request->get('email'));
        }

        return $query;
    }

    public function identity()
    {
        return $this->hasOne('App\Models\Identity', 'user_id');
    }

    public function member()
    {
        return $this->hasOneThrough('App\Models\Member', 'App\Models\Identity');
    }
}
