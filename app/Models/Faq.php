<?php

namespace App\Models;

use App\Traits\SortableTrait;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    //
    use SortableTrait;
    protected $table = 'faq';

    protected $fillable = [
        'user_id','question','answer','moderated','product_id'
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function product(){
        return $this->belongsTo('App\Models\Product\Product');
    }

}
