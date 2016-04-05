<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 05.04.16
 * Time: 20:58
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['order_id', 'user_saw', 'supplier_saw', 'text', 'user_id'];

    public function order(){
        return $this->belongsTo('App\Models\Order');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }
}