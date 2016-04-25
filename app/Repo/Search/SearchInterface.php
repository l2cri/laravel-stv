<?php
/**
 * Created by PhpStorm.
 * User: l2cri
 * Date: 25.04.16
 * Time: 13:19
 */

namespace App\Repo\Search;

interface SearchInterface {

    public function __call($function, $args);

    public function all($keyword);
}