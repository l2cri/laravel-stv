<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 08.06.16
 * Time: 21:24
 */

namespace App\Services\Delivery\Boxberry\Models;

use Illuminate\Database\Eloquent\Model;

class BoxberryPointsCities extends Model
{
    protected $table = 'boxberry_points_cities';
    protected $fillable = ['location_id', 'name', 'code', 'country_code'];
    public $timestamps = false;

    public function location(){
        return $this->belongsTo('App\Models\Location');
    }

    public function points(){
        return $this->hasMany('App\Services\Delivery\Boxberry\Models\BoxberryPoints', 'bpc_id');
    }
}