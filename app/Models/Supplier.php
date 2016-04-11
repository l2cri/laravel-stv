<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 08.12.15
 * Time: 16:44
 */

namespace App\Models;

use App\Traits\SortableTrait;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use SortableTrait;
    protected $prefix = "suppliers";

    protected $fillable = ['name', 'description', 'conditions', 'responsibility',
                            'whosale_order', 'whosale_quantity', 'color', 'logo', 'code'];

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

    public function actions(){
        return $this->hasMany('App\Models\Action');
    }

    public function company() {
        return $this->hasOne('App\Models\Company');
    }
}