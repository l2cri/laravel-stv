<?php

namespace App\Models;

use App\Traits\SortableTrait;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    use SortableTrait;
    protected $table = 'comments';

    protected $fillable = [
        'user_id','text'
    ];

    public function commentable(){
        return $this->morphTo();
    }
}
