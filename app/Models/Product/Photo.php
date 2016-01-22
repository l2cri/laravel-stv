<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 19.01.16
 * Time: 20:28
 */

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $table = 'photos';
    protected $fillable = ['file', 'product_id'];

    public function product()
    {
        return $this->belongsTo('App\Models\Product\Product');
    }
}