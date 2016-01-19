<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 15.12.15
 * Time: 15:52
 */

namespace App\Models;

use Kalnoy\Nestedset\Node;

class Section extends Node
{
    protected $table = 'sections';
    protected $fillable = ['name', 'description', 'icon', 'active', 'moderated', 'user_id'];

//    public function parent(){
//        return $this->belongsTo('\App\Models\Section', 'parent_id');
//    }

    public function getUrlAttribute(){
        $param = (!empty($this->code)) ? $this->code : $this->id;
        return '/catalog/'.$param;
    }

    public function products(){
        return $this->belongsToMany('App\Models\Product\Product');
    }
}