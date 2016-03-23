<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 18.02.16
 * Time: 18:47
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['user_id', 'supplier_id', 'profile_id', 'subtotal', 'total', 'comment', 'innercomment', 'status_id'];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function supplier(){
        return $this->belongsTo('App\Models\Supplier');
    }

    public function profile(){
        return $this->belongsTo('App\Models\Profile');
    }

    public function cartItems(){
        return $this->hasMany('App\Models\CartItem');
    }

    public function status(){
        return $this->belongsTo('App\Models\Status');
    }
}