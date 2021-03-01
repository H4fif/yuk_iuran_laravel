<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'permissions', 'last_login', 'first_name', 'last_name', 'created_at', 'updated_at', 'photo', 'phone_number', 'date_of_birth', 'address', 'area_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roleUser() {
        return $this->hasOne('App\RoleUser');
    }

    public function findUserById($id) {
        return User::where('user_id', $id)->first();
    }

    public function getAll() {
        return User::select('id', 'name', 'email', 'password', 'permissions', 'last_login', 'first_name', 'last_name', 'created_at', 'updated_at', 'photo', 'phone_number', 'date_of_birth', 'address', 'area_id')->get();
    }

    public function store($data) {
        $data_user = [
            'email' => $data->email,
            'password' => $data->password,
            'first_name' => $data->first_name,
            'last_name' => $data->last_name,
            'photo' => $data->photo,
            'phone_number' => $data->phone_number,
        ];
    }
}
