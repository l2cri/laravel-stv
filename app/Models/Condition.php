<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 15.03.16
 * Time: 19:36
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Condition extends Model
{
    protected $table = "conditions";

    protected $fillable = ['conditionable_id', 'conditionable_type', 'name', 'type', 'target', 'value', 'attrubutes'];

    public function conditionable(){
        return $this->morphTo();
    }
}