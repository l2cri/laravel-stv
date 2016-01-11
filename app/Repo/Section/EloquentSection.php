<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 24.12.15
 * Time: 17:53
 */

namespace App\Repo\Section;

use Illuminate\Database\Eloquent\Model;
use Auth;

class EloquentSection implements SectionInterface
{
    protected $section;

    public function __construct(Model $section) {
        $this->section = $section;
    }

    public function byId($id){}
    public function byCode($code){}

    public function create(array $data){
        $section = $this->section->create(array(
            'user_id' => $data['user_id'],
            'parent_id' => $data['parent_id'],
            'name' => $data['name'],
        ));

        if (!$section) return false;
        return true;
    }

    public function delete($id){

        $section =  $this->section->find($id);

        // проверяем, что она не отмодерирована
        if ($section->moderated) return;

        // проверяем, что категория создана пользователем
        if ( Auth::user()->id == $section->user_id )
            $this->section->destroy($id);
    }

    public function getPath($id) {

    }

    public function getTree($id = null) {

    }

    public function byUser($userId){
        return $this->section->where('user_id', $userId)->get();
    }
    public function bySupplier($supplierId){}
}