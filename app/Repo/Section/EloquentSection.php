<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 24.12.15
 * Time: 17:53
 */

namespace App\Repo\Section;

use Auth;
use Kalnoy\Nestedset\Node;

class EloquentSection implements SectionInterface
{
    protected $section;

    public function __construct(Node $section) {
        $this->section = $section;
    }

    public function byId($id){}
    public function byCode($code){

        $section = $this->section->where('code', $code)->withDepth()->first();
        if (is_null($section)) $section = $this->section->withDepth()->find($code);

        return $section;
    }

    public function create(array $data){

        $section = $this->section->create(array(
            'user_id' => $data['user_id'],
            //'parent_id' => $data['parent_id'],
            'name' => $data['name'],
        ));

        if (!$section) return false;

        if (!empty($data['parent_id'])) {
            $parentNode = $this->section->find($data['parent_id']);
            $parentNode->appendNode($section);
        }

        return true;
    }

    public function delete($id){

        $section =  $this->section->find($id);

        // проверяем, что она не отмодерирована
        if ($section->moderated) return;

        // проверяем, что категория создана пользователем
        if ( Auth::user()->id == $section->user_id )
            $section->delete(); // из Kalnoy\Nestedset\Node чтобы пересчитались тл др
    }

    public function getPath($id) {

    }

    public function getTree($id = null) {

        if (!empty($id)){
            $results = $this->section->withDepth()->defaultOrder()->descendantsOf($id);
        } else {
            $results = $this->section->withDepth()->defaultOrder()->get();
        }

        $results->linkNodes();

        return $results;
    }

    public function byUser($userId){
        return $this->section->where('user_id', $userId)->withDepth()->defaultOrder()->get();
    }
    public function bySupplier($supplierId){

        $allSectionsTree = array();

        $sections = $this->section->whereHas('products', function($q) use ($supplierId)
        {
            $q->where('supplier_id', $supplierId);
        })->withDepth()->defaultOrder()->get();

        foreach ($sections as $section) {
            // добавляем в главный массив по айдишнику эту секцию
            $allSectionsTree[ $section->id ] = $section;

            // потомки не нужны, но пока оставим
//            // достаем потомков этой секции
//            $descendants = $this->getTree( $section->id );
//
//            // добавляем всех потомков в общий массив, айдишник позволит отфильтровать дубли
//            foreach ($descendants as $des) {
//                $allSectionsTree[ $des->id ] = $des;
//            }
        }

        // убираем глубину, ставим ее один, категориям, у которых нет родителей в массиве
        foreach ($allSectionsTree as $key => $sec) {
            if ( !array_key_exists($sec->parent_id, $allSectionsTree) )
                $allSectionsTree[ $key ][ 'depth' ] = 1;
        }

        return $sections;
    }
}