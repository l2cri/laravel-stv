<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 02.06.16
 * Time: 12:46
 */

namespace App\Services\Delivery\Boxberry\Models;


use Illuminate\Database\Eloquent\Model;

class BoxberryCourierZips extends Model
{
    protected $table = 'boxberry_courier_zips';
    protected $fillable = ['zip', 'city', 'area'];
    public $timestamps = false;
}