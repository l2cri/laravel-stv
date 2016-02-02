<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 02.02.16
 * Time: 18:23
 */

namespace App\Http\ViewComposers;


use Illuminate\Http\Request;
use Illuminate\View\View;

class FilterComposer
{
    protected $request;

    public function __construct(Request $request) {
        $this->request = $request;
    }

    public function compose(View $view){

        $urlArr = array();

        // цены
        if ($this->request->has('minprice') && $this->request->has('maxprice')) {
            $urlArr[] = 'minprice='.$this->request->input('minprice');
            $urlArr[] = 'maxprice='.$this->request->input('maxprice');
        }

        // поставщики
        if ($this->request->has('suppliers')) {
            foreach ($this->request->input('suppliers') as $supplier){
                if (!empty($supplier)) $urlArr[] = 'suppliers[]='.$supplier;
            }
        }

        $supplementUrl = implode('&', $urlArr);

        $view->with('supplementUrl', $supplementUrl);
    }
}