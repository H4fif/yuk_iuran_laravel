<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Sentinel;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'permissions', 'last_login', 'first_name', 'last_name', 'created_at', 'updated_at', 'photo', 'phone_number', 'birth_date', 'address', 'area_id',
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
        return User::select('id', 'first_name', 'last_name', 'email', 'password', 'permissions', 'last_login', 'first_name', 'last_name', 'created_at', 'updated_at', 'photo', 'phone_number', 'birth_date', 'address', 'area_id')->get();
    }

    public function store($data) {
        $newUser = [
          'email' => $data->email,
          'password' => $data->password,
          'first_name' => $data->first_name,
          'last_name' => $data->last_name,
          'birth_date' => $data->birth_date,
          'phone_number' => $data->phone_number,
          'address' => $data->address,
          'area_id' => $data->area_id,
          'photo' => $data->photo
      ];

      $userRegistration = Sentinel::registerAndActivate($newUser);

      if ($userRegistration) {
          $user = User::where('id', $userRegistration->id)
                          ->update([
                              'birth_date' => $data->birth_date,
                              'phone_number' => $data->phone_number,
                              'address' => $data->address,
                              'area_id' => $data->area_id,
                              'photo' => $data->photo
                          ]);
          return $user ;
      } else {
          return false;
      }
    }
}
