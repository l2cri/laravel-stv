<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 15.12.15
 * Time: 15:52
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $fillable = ['parent_id', 'name', 'description', 'icon', 'active', 'moderated', 'user_id'];

    public function parent(){
        return $this->belongsTo('\App\Models\Section', 'parent_id');
    }
}