<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $table = 'districts';
    protected $fillable = [];

    public function regency() {
        return $this->hasMany('App\Regency');
    }

    public function village() {
        return $this->belongsToMany('App\Village');
    }

    public function getAll() {
        return District::select('id', 'regency_id', 'name')->get();
    }
}
