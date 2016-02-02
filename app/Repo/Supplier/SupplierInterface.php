<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 02.02.16
 * Time: 19:55
 */

namespace App\Repo\Supplier;


use Illuminate\Support\Collection;

interface SupplierInterface
{
    public function byId($id);
    public function byCode($code);
    public function update(array $data, $id, $attribute="id");
    public function bySection($sectionId, $includeSubsections = true);
    public function byProducts(Collection $products);
}