<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 01.06.16
 * Time: 19:28
 */

namespace App\Services\Delivery\Boxberry\Models;

use Illuminate\Database\Eloquent\Model;

class BoxberryCourierCities extends Model
{
    protected $table = 'boxberry_courier_cities';
    protected $fillable = ['location_id', 'name', 'time'];
    public $timestamps = false;

    public function location(){
        return $this->belongsTo('App\Models\Location');
    }
}