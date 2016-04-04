<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 25.03.16
 * Time: 17:07
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Action extends Model
{
    protected $table = 'actions';
    protected $fillable = ['active', 'name', 'description', 'start', 'end', 'percent', 'static', 'supplier_id'];

    public function products(){
        return $this->hasMany('App\Models\Product\Product');
    }

    public function supplier() {
        return $this->belongsTo('App\Models\Supplier');
    }
}