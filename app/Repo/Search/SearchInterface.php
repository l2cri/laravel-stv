<?php
/**
 * Created by PhpStorm.
 * User: l2cri
 * Date: 25.04.16
 * Time: 13:19
 */

namespace App\Repo\Search;

interface SearchInterface {
    public function products($keyword);

    public function suppliers($keyword);

    public function all($keyword);
}