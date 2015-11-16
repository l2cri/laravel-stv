<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 16.11.15
 * Time: 21:01
 */

namespace App\Repo\Infopage;


use Illuminate\Database\Eloquent\Model;

class EloquentInfopage implements InfopageInterface
{
    protected $infopage;

    public function __construct(Model $infopage){
        $this->infopage = $infopage;
    }

    public function byCode($code){
        return $this->infopage->where('code', $code)->first();
    }
}