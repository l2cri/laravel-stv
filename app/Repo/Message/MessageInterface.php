<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 05.04.16
 * Time: 23:54
 */

namespace App\Repo\Message;


use App\Repo\RepoInterface;

interface MessageInterface extends RepoInterface
{
    public function userSaw($orderId);
    public function supplierSaw($orderId);
    public function userNew($orderId);
    public function supplierNew($orderId);
}