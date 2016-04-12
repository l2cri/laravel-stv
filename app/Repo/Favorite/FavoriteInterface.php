<?php
/**
 * Created by PhpStorm.
 * User: l2cri
 * Date: 05.04.16
 * Time: 16:15
 */

namespace App\Repo\Favorite;

use App\Repo\RepoInterface;

interface FavoriteInterface extends RepoInterface
{
    public function add($product_id,$user_id);
    public function delete($id);
}