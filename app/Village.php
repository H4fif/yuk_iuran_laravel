<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Village extends Model
{
    protected $table = 'villages';
    protected $fillable = [];

    /**
     * Define relationship with districts table
     */
    public function district() {
        return $this->hasMany('App\District');
    }

    /**
     * Define relationship with users table
     */
    public function user() {
        return $this->belongsToMany('App\User');
    }

    /**
     * Get all records from villages table
     * Default limit 100
     */
    public function getAll($limit = 100) {
        return Village::select(
                      'villages.id',
                      'provinces.name as province',
                      'regencies.name as regency',
                      'districts.name as district',
                      'villages.name as village'
                  )
                    ->join('districts', 'villages.district_id', '=', 'districts.id')
                    ->join('regencies', 'regencies.id', '=', 'districts.regency_id')
                    ->join('provinces', 'provinces.id', '=', 'regencies.province_id')
                    ->limit($limit)
                    ->get();
    }

    /**
     * Get a record from villages table by specified id
     */
    public function getById($id) {
        return Village::select(
                      'villages.id',
                      'provinces.name as province',
                      'regencies.name as regency',
                      'districts.name as district',
                      'villages.name as village'
                  )
                    ->join('districts', 'villages.district_id', '=', 'districts.id')
                    ->join('regencies', 'regencies.id', '=', 'districts.regency_id')
                    ->join('provinces', 'provinces.id', '=', 'regencies.province_id')
                    ->where('villages.id', '=', $id)
                    ->get();
    }
}
