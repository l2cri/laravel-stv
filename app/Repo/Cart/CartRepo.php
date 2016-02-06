<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 06.02.16
 * Time: 4:18
 */

namespace App\Repo\Cart;
use Cart;

class CartRepo implements CartInterface
{

    public function add($data)
    {
        // TODO: Implement add() method.
    }

    public function update($id, $data)
    {
        // TODO: Implement update() method.
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
    }

    public function save()
    {
        // TODO: Implement save() method.
    }

    public function all()
    {
        return Cart::getContent();
    }

}