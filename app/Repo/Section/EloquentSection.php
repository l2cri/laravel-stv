<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 24.12.15
 * Time: 17:53
 */

namespace App\Repo\Section;

use Illuminate\Database\Eloquent\Model;

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

    // TODO: учесть при удалении что user_id категории == user_id пользователя
    public function delete($id){}

    public function getPath($id) {

    }

    public function getTree($id) {

    }

    public function byUser($userId){}
    public function bySupplier($supplierId){}
}