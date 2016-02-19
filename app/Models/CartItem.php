<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 18.02.16
 * Time: 19:03
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    protected $table = 'cart_items';

    protected $fillable = ['user_id', 'order_id', 'product_id', 'price', 'final_price',
                            'subtotal', 'total', 'comment', 'name', 'quantity', 'attributes'];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function order(){
        return $this->belongsTo('App\Models\Order');
    }

    public function product(){
        return $this->belongsTo('App\Models\Product\Product');
    }
}