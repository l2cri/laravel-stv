<?php
/**
 * Created by PhpStorm.
 * User: l2cri
 * Date: 08.04.16
 * Time: 13:37
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    protected $table = 'favorite';
    public $timestamps = false;

    protected $fillable = [
        'user_id','product_id'
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function product(){
        return $this->belongsTo('App\Models\Product\Product');
    }
}