<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    protected $table = 'provinces';
    protected $fillable = [];

    public function regency() {
        return $this->belongsToMany('App\Regency');
    }

    public function getAll() {
        return Province::select('id', 'name')->get();
    }
}
