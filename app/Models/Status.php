<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 22.03.16
 * Time: 15:11
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model {

    public $timestamps = false;
    protected $table = 'statuses';
    protected $fillable = ['name', 'color'];

    public function orders(){
        return $this->hasMany('App\Models\Order');
    }
}