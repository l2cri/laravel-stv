<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 26.01.16
 * Time: 18:05
 */

namespace App\Traits;

use Illuminate\Pagination\Paginator;


trait SortableTrait
{
    /**
     * @param $query
     * @return mixed
     * сортировка
     */
    public function scopeSortable($query) {
        return $query->orderBy( $this->getOrder(), $this->getDirection());
    }

    public function getDirection(){
        $dir = ( !empty(\Input::get('dir')) ) ? \Input::get('dir') : \Input::session()->get('dir', 'desc');

        if ( !empty(\Input::get('dir'))) {
            \Input::session()->put('dir', \Input::get('dir'));
        }

        return $dir;
    }

    public function getOrder(){
        $order = ( !empty(\Input::get('order')) ) ? \Input::get('order') : \Input::session()->get('order', 'id');
        if ( !empty(\Input::get('order')) ) {
            \Input::session()->put('order', \Input::get('order'));
        }

        return $order;
    }

    /**
     * @param $query
     * @return mixed
     * пагинация
     */
    public function scopePaginable($query, $page = null){

        if (!$page)
            $page = ( !empty(\Input::get('page')) ) ? \Input::get('page') : 1;

        Paginator::currentPageResolver(function() use ($page) {
            return $page;
        });

        return $query->paginate( $this->getPerPage());
    }

    public function getPerPage(){
        $limit = ( !empty(\Input::get('limit')) ) ? \Input::get('limit') : \Input::session()->get('limit', 12);
        if ( !empty(\Input::get('limit')) ) {
            \Input::session()->put('limit', \Input::get('limit'));
        }
        return $limit;
    }
}