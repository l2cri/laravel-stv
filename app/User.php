<?php

namespace App;

use Hash;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password', 'admin'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function isAdmin() {
        return $this->attributes['admin'];
    }

    public function roles()
    {
        return $this->belongsToMany('App\Models\Role');
    }

    // мутатор для админки
    public function setRolesAttribute($roles)
    {
        $this->roles()->detach();
        if ( ! $roles) return;
        if ( ! $this->exists) $this->save();

        $this->roles()->attach($roles);
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    /*
     * Поставщики
     */
    public function suppliers()
    {
        return $this->hasMany('App\Models\Supplier');
    }

    public function profiles(){
        return $this->hasMany('App\Models\Profile');
    }

    public function orders(){
        return $this->hasMany('App\Models\Order');
    }

    public function cartItems(){
        return $this->hasMany('App\Models\CartItem');
    }

    public function comments(){
        return $this->hasMany('App\Models\Comment');
    }

    public function messages(){
        return $this->hasMany('App\Models\Message');
    }
}
