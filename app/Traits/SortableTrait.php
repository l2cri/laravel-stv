<?php/** * Created by PhpStorm. * User: ley * Date: 26.01.16 * Time: 18:05 */namespace App\Traits;use Illuminate\Pagination\Paginator;trait SortableTrait{    /**     * @param $query     * @return mixed     * сортировка     */    public function scopeSortable($query) {        return $query->orderBy( $this->getOrder(), $this->getDirection());    }    public function getDirection(){        $dir = ( !empty(\Input::get('dir')) ) ? \Input::get('dir') : \Input::session()->get('dir', 'desc');        if ( !empty(\Input::get('dir'))) {            \Input::session()->put('dir', \Input::get('dir'));        }        return $dir;    }    public function getOrder(){        $str = $this->prefix."order";        $order = ( !empty(\Input::get($str)) ) ? \Input::get($str) : \Input::session()->get($str, 'id');        if ( !empty(\Input::get($str)) ) {            \Input::session()->put($str, \Input::get($str));        }        return $order;    }    /**     * @param $query     * @return mixed     * пагинация     */    public function scopePaginable($query, $page = null, $limit = null){        if (!$page)            $page = ( !empty(\Input::get('page')) ) ? \Input::get('page') : 1;        Paginator::currentPageResolver(function() use ($page) {            return $page;        });        return $query->paginate( $this->getPerPage($limit));    }    public function getPerPage($limit = null){        if (!$limit) {            $limit = ( !empty(\Input::get('limit')) ) ? \Input::get('limit') : \Input::session()->get('limit', 12);            if ( !empty(\Input::get('limit')) ) {                \Input::session()->put('limit', \Input::get('limit'));            }        }        return $limit;    }}