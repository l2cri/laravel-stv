<?php

namespace App\Models;

use App\Traits\PathImageTrait;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    //
    use PathImageTrait;
    protected $table = 'banners';

    protected $fillable = [
        'name','url','image','sort'
    ];
}
