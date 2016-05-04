<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 18.02.16
 * Time: 17:20
 */

namespace App\Repo\Order;


use App\Repo\RepoInterface;

interface OrderInterface extends RepoInterface
{
    public function statuses();
    public function byWhereIn($field, array $array);
    public function deliveries();
    public function payments();
}