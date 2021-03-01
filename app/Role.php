<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        'name', 'slug', 'permissions'
    ];

    public function RoleUser() {
        return $this->belongsToMany('App\RoleUser', 'role_users', 'role_id');
    }

    public function getAll() {
        return Role::select('id', 'name', 'slug', 'permissions')->get();
    }

    public function store($data) {
        $result = Sentinel::getRoleRepository()->createModel()->create([
            'name' => $data->name,
            'slug' => $data->slug,
            'permission' => [
                'admin' => true,
                'user' => true,
            ]
        ]);

        return $result;
    }

    public function update($data) {
        $result = Role::findOrFail($data->role_id)->update([
            'name' => $data->name,
            'slug' => $data->slug
        ]);

        return $result;
    }
}
