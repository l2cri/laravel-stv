<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 25.03.16
 * Time: 17:40
 */

namespace App\Repo\Action;


use App\Repo\RepoInterface;

interface ActionInterface extends RepoInterface
{
    public function bySupplier($supplierId);
}