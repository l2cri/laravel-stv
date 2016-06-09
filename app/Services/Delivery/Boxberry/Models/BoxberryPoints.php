<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 08.06.16
 * Time: 21:27
 */

namespace App\Services\Delivery\Boxberry\Models;

use Illuminate\Database\Eloquent\Model;

class BoxberryPoints extends Model
{
    protected $table = 'boxberry_points';
    protected $fillable = ['bpc_id', 'code', 'name', 'address', 'phone', 'work_schedule', 'trip_description',
                            'delivery_period', 'city_code', 'city_name', 'tarif_zone', 'settlement', 'area', 'country',
                            'only_prepaid_orders', 'address_reduce', 'acquiring',
                            'digital_signature', 'office_type', 'nal_kd', 'metro', 'gps'];
    public $timestamps = false;

    public function city(){
        return $this->belongsTo('App\Services\Delivery\Boxberry\Models\BoxberryPointsCities', 'bpc_id');
    }
}