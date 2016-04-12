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

    public function getPathAttribute(){

        $path = "";
        $ancestors = $this->ancestors()->defaultOrder()->get();

        foreach ($ancestors as $ancestor) {
            if ( ($ancestor->shortname == 'р-н') || ($ancestor->shortname == 'обл') )
                $path .= $ancestor->name .' '.$ancestor->shortname;
        }

        return $path;
    }

    public function suppliers(){
        return $this->belongsToMany('App\Models\Supplier');
    }

    public function profiles(){
        return $this->hasMany('App\Models\Profile');
    }
}