<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 12.04.16
 * Time: 11:45
 */

namespace App\Models;


use Kalnoy\Nestedset\Node;

class Location extends Node
{
    protected $table = 'locations';
    protected $fillable = ['name', 'regioncode', 'aoguid', 'parentguid', 'auid', 'level', 'shortname'];
    protected $appends = ['path'];
    protected $regions = ['край', 'р-н', 'обл'];

    public function getPathAttribute(){

        $path = array();
        $ancestors = $this->ancestors()->get();
        $ancestors[] = $this;

        foreach ($ancestors as $ancestor) {
            if ( in_array($ancestor->shortname, $this->regions) )
                $path []= $ancestor->name .' '.$ancestor->shortname.'.';
            else $path []= $ancestor->shortname.'. '.$ancestor->name;
        }

        return implode(', ', $path);
    }

    public function suppliers(){
        return $this->belongsToMany('App\Models\Supplier');
    }

    public function profiles(){
        return $this->hasMany('App\Models\Profile');
    }
}