<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 13.04.16
 * Time: 12:09
 */

namespace App\Repo\Location;


interface LocationInterface
{
    public function saveDeliveryZone(array $locationIds, $supplierId);
    public function getByName($locationName);
    public function getTree($level);
    public function getByGeoIp();
    public function getSessionLocation();
    public function setSessionLocation($locationId);
}