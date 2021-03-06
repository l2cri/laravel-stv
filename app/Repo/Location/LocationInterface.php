<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 13.04.16
 * Time: 12:09
 */

namespace App\Repo\Location;


use App\Repo\RepoInterface;

interface LocationInterface extends RepoInterface
{
    public function saveDeliveryZone(array $locationIds, $supplierId);
    public function getByName($locationName);
    public function getTree($level);
    public function getByGeoIp();
    public function getSessionLocation();
    public function setSessionLocation($locationId);
    public function getJson($parentId, $supplierId);
    public function getBySupplier($supplierId);
    public function getByQuery($query);
}