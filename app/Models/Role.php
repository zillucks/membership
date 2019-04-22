<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

use App\Traits\ActiveIdentifier;

class Role extends Model
{
    use ActiveIdentifier;

    protected $table = 'roles';

    protected static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub
	    static::creating(function ($model) {
	    	$model->slug = str_slug($model->role_name);
        });
        
        static::updating(function ($model) {
            $model->slug = str_slug($model->role_name);
        });
    }

    public function scopeFilter($query, Request $request)
    {
        if ($request->has('role_name') && !empty($request->get('role_name'))) {
            $rolename = strtolower($request->get('role_name'));

            $query->whereRaw('lower(role_name) like ?', '%'. $rolename .'%');
        }
        if ($request->has('slug') && !empty($request->get('slug'))) {
            $query->wehre('slug', $request->get('slug'));
        }

        return $query;
    }

    public function members()
    {
        return $this->hasMany('App\Models\Member', 'role_id');
    }

    public function navigations()
    {
        return $this->belongToMany('App\Models\Navigation', 'navigation_role', 'navigation_id', 'role_id');
    }
}