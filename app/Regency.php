<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Regency extends Model
{
    protected $table = 'regencies';
    protected $fillable = [];

    public function province() {
        return $this->hasMany('App\Province');
    }

    public function district() {
        return $this->belongsToMany('App\District');
    }

    public function getAll() {
        return Regency::select('regencies.id', 'province_id', 'regencies.name')
                    ->join('provinces', 'provinces.id', '=', 'regencies.province_id')
                    ->get();
    }
}
