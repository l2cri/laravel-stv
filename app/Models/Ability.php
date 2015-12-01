<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 01.12.15
 * Time: 12:25
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Ability extends Model
{
    protected $fillable = ['name', 'description', 'action'];

    public function roles()
    {
        return $this->belongsToMany('App\Models\Role');
    }
}