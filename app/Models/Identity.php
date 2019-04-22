<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

class Identity extends Model
{
    use SoftDeletes;

    protected $table = 'identity';

    /**
     * filter data by fullname or email
     */
    public function scopeFilter($query, Request $request)
    {
        if ($request->has('full_name') && !empty($request->get('full_name'))) {
            $fullname = strtolower($request->get('full_name'));
            $query->whereRaw('lower(full_name) like ?', '%'. $fullname .'%');
        }
        if ($request->has('email') && !empty($request->get('email'))) {
            $query->whereRaw('lower(email) = ?', strtolower($request->get('email')));
        }
        if ($request->has('search') && !empty($request->get('search'))) {
            $search = strtolower($request->get('search'));
            $query->whereRaw('lower(full_name) like ?', '%'. $search .'%');
        }

        return $query;
    }

    /**
     * relation for user
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function member()
    {
        return $this->hasOne('App\Models\Member');
    }
}
