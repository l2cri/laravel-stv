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
    protected $table = 'products';
    protected $fillable = ['active', 'name', 'description', 'start', 'end', 'percent', 'static'];

    public function products(){
        return $this->hasMany('App\Models\Product\Product');
    }
}