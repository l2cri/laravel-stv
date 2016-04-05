<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 19.01.16
 * Time: 19:55
 */

namespace App\Models\Product;

use App\Traits\SortableTrait;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use SortableTrait;

    protected $prefix = "products";

    protected $table = 'products';
    protected $fillable = ['active', 'moderated', 'available', 'featured', 'name', 'articul', 'barcode', 'unit',
        'length', 'width', 'height', 'weight', 'volume', 'price', 'regular_price', 'action_price', 'whosale_price',
        'whosale_quantity', 'preview', 'description', 'supplier_id', 'sections', 'action_id'];

    public function sections(){
        return $this->belongsToMany('App\Models\Section');
    }

    public function photos(){
        return $this->hasMany('App\Models\Product\Photo');
    }

    public function supplier()
    {
        return $this->belongsTo('App\Models\Supplier');
    }

    public function cartItems(){
        return $this->hasMany('App\Models\CartItem');
    }

    public function comments(){
        return $this->morphMany('App\Models\Comment', 'commentable');
    }

    public function action(){
        return $this->belongsTo('App\Models\Action');
    }

    public function faq(){
        return $this->hasMany('App\Models\Faq');
    }
}