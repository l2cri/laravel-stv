<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 04.05.16
 * Time: 14:21
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    protected $table = 'deliveries';
    protected $fillable = ['active','name','description','settings','type'];

    public function orders(){
        return $this->hasMany('App\Models\Order');
    }
}