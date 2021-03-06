<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 19.01.16
 * Time: 20:51
 */

namespace App\Repo\Product;


use App\Repo\RatingIterface;
use App\Repo\RepoInterface;

interface ProductInterface extends RatingIterface, RepoInterface
{
    public function byId($id);
    public function create(array $data);
    public function update(array $data, $id, $attribute="id");
    public function delete($id);

    public function bySupplier($supplierId);
    public function bySection($sectionId, $includeSubsections = true);
    public function bySectionIds (array $ids);
    public function bySectionWithSupplier($sectionId, $supplierId, $includeSubsections = true);
    public function bySupplierPaginate($supplierId);

    public function paginate();
    public function findBy($field, $value, $columns = array('*'));
    public function allProductsFromLastRequest();
    public function datatables($attribute, $value, $columns = array('*'));
}