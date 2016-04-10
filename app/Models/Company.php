<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 09.04.16
 * Time: 13:55
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'companies';
    protected $fillable = [ 'user_id', 'supplier_id' , 'name', 'ogrn', 'inn', 'kpp', 'rs', 'ks',
                            'ceo', 'phone', 'email', 'law_address', 'fact_address'];

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function supplier() {
        return $this->belongsTo('App\Models\Supplier');
    }

    public function profiles() {
        return $this->hasMany('App\Models\Profile');
    }
}