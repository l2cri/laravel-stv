<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 14.04.16
 * Time: 12:47
 */

namespace App\Services\Form\Location;


use App\Services\Validation\AbstractLaravelValidator;

class LocationValidator extends AbstractLaravelValidator
{
    protected $rules = array(
        'locationIds' => 'array',
        'supplierId' => 'numeric',
    );
}