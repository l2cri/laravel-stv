<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 09.04.16
 * Time: 16:38
 */

namespace App\Services\Form\Company;


use App\Services\Validation\AbstractLaravelValidator;

class CompanyValidator extends AbstractLaravelValidator
{
    protected $rules = array(

        'user_id' => 'numeric',
        'supplier_id' , 'numeric',
        'name' => 'string',
        'ogrn' => 'string',
        'inn' => 'string',
        'kpp' => 'string',
        'rs' => 'string',
        'ks' => 'string',
        'bik' => 'string',
        'ceo' => 'string',
        'phone' => 'string',
        'email' => 'email',
        'law_address' => 'string',
        'fact_address' => 'string',
        'company_id' => 'numeric'
    );
}