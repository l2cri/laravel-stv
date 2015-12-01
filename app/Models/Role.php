<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 30.11.15
 * Time: 11:05
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['name'];

    public function users()
    {
        return $this->belongsToMany('App\User');
    }

    public function abilities()
    {
        return $this->belongsToMany('App\Models\Ability');
    }

    // мутатор для админки
    public function setAbilitiesAttribute($abilities)
    {
        $this->abilities()->detach();
        if ( ! $abilities) return;
        if ( ! $this->exists) $this->save();

        $this->abilities()->attach($abilities);
    }
}