<?php
/**
 * Created by PhpStorm.
 * User: Unizoo5
 * Date: 24.03.2016
 * Time: 17:32
 */

namespace App\Repo\Comment;


use App\Repo\RepoInterface;

interface CommentInterface extends RepoInterface
{
    public function create(array $data);
    public function getByObject($object);
}