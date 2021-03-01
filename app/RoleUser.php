<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
    protected $table = 'role_users';

    protected $fillable = [
        'user_id', 'role_id'
    ];

    public function user() {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function Role() {
        return $this->belongsTo('App\Role', 'role_id', 'id');
    }
}
