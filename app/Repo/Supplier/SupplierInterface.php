<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 02.02.16
 * Time: 19:55
 */

namespace App\Repo\Supplier;

use App\Repo\RepoInterface;
use App\Repo\RatingIterface;
use Illuminate\Support\Collection;

interface SupplierInterface extends RepoInterface,RatingIterface
{
    public function byId($id);
    public function byCode($code);
    public function update(array $data, $id, $attribute="id");
    public function bySection($sectionId, $includeSubsections = true);
    public function byProducts(Collection $products);
    public function byProductsPaginate(Collection $products);
    public function allPaginate();
}