<?php
/**
 * Created by PhpStorm.
 * User: l2cri
 * Date: 19.04.16
 * Time: 12:32
 */

namespace App\Repo\Banners;


use App\Repo\RepoInterface;

interface BannerInterface extends RepoInterface
{
    public function sortable($order,$by,$type = null);
}