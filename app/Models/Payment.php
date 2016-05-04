<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 04.05.16
 * Time: 14:25
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payments';
    protected $fillable = ['active','name','description','settings','type'];

    public function orders(){
        return $this->hasMany('App\Models\Order');
    }
}