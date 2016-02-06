<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 06.02.16
 * Time: 4:16
 */

namespace App\Repo\Cart;


interface CartInterface
{
    public function add($data);
    public function update($id, $data);
    public function delete($id);
    public function save();
    public function all();
}