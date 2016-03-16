<?php

namespace App\Models;

use App\Traits\SortableTrait;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use SortableTrait;
    //
    protected $table = 'news';

    protected $fillable = [
        'name','text','image'
    ];

}
