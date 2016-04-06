<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 06.02.16
 * Time: 4:16
 */

namespace App\Repo\Cart;


use App\Repo\RepoInterface;

interface CartInterface extends RepoInterface
{
    public function add($data);
    public function delete($id);
    public function save($items, $orderId = null, $userId = null);
    public function clear();
    public function updateOrderCart($data);
    public function addOrderCartItem($userId, $orderId, $data);
    public function cartConditions($item, $cart);
    public function deleteCondition($orderId, $conditionId, $userId);
}