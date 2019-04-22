<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\ActiveIdentifier;
use Illuminate\Http\Request;

class MemberType extends Model
{
    use ActiveIdentifier;
    
    protected $table = 'member_type';

    public function scopeFilter($query, Request $request)
    {
        if ($request->has('member_type') && !empty($request->get('member_type'))) {
            $type = strtolower($request->get('member_type'));
            $query->whereRaw('lower(member_type_name) like ?', '%'. $type .'%');
        }

        return $query;
    }

    public function member()
    {
        return $this-hasMany('App\Models\Member');
    }
}
