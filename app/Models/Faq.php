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

    public function scopeByProductItems($query,$product_id, $limit = null,$order = null){

        if(!$limit) $limit = 7;

        $arOrder = ($order) ?['order'=>$order[0],'by'=>$order[1]] :['order'=>'created_at','by'=>'desc'];

        return $query
            ->where('product_id',$product_id)
            ->orderBy($arOrder['order'], $arOrder['by'])
            ->paginable(null, $limit);
    }

}
