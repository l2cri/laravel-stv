<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 08.12.15
 * Time: 16:44
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = ['name', 'description', 'conditions', 'responsibility',
                            'whosale_order', 'whosale_quantity', 'color', 'logo'];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function products()
    {
        return $this->hasMany('App\Models\Product\Product');
    }

    public function orders(){
        return $this->hasMany('App\Models\Order');
    }
}