<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 19.01.16
 * Time: 19:55
 */

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $fillable = ['active', 'moderated', 'available', 'featured', 'name', 'articul', 'barcode', 'unit',
        'length', 'width', 'height', 'weight', 'volume', 'price', 'regular_price', 'action_price', 'whosale_price',
        'whosale_quantity', 'preview', 'description', 'supplier_id'];

    public function sections(){
        return $this->belongsToMany('App\Models\Section');
    }

    public function images(){
        return $this->hasMany('App\Models\Product\Photo');
    }
}