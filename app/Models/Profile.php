<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 15.02.16
 * Time: 18:16
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = ['name', 'person', 'phone', 'address', 'user', 'user_id'];

    public function user(){
        return $this->belongsTo('App\User');
    }
}