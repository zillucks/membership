<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use App\Traits\ActiveIdentivier;

class Navigation extends Model
{
    use ActiveIdentivier, SoftDeletes;

    protected $table = 'navigation';

    public function main()
    {
        return $this->belongsTo('App\Models\Navigation', 'parent_id');
    }

    public function branch()
    {
        return $this->hasMany('App\Models\Navigation', 'parent_id');
    }

    public function roles()
    {
        return $this->belongsToMany('App\Models\Roles', 'navigation_role', 'role_id', 'navigation_id');
    }
    
}
