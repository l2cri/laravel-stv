<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 14.04.16
 * Time: 13:08
 */

namespace App\Services\Form\Location;


use App\Repo\Location\LocationInterface;
use App\Services\Form\FormTrait;
use App\Services\Validation\ValidableInterface;

class LocationForm
{
    use FormTrait;

    protected $validator;
    protected $location;

    public function __construct(ValidableInterface $validator, LocationInterface $location) {
        $this->validator = $validator;
        $this->location = $location;
    }

    public function saveDeliveryZone(array $data, $supplierId){
        if ( ! $this->valid($data) ) return false;

        $this->location->saveDeliveryZone($data['selectedLocations'], $supplierId);
    }
}