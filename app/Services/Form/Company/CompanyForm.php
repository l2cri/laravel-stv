<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 09.04.16
 * Time: 16:36
 */

namespace App\Services\Form\Company;


use App\Repo\Company\CompanyInterface;
use App\Services\Form\FormTrait;
use App\Services\Validation\AbstractLaravelValidator;

class CompanyForm
{
    protected $validator;
    protected $company;

    use FormTrait;

    public function __construct(AbstractLaravelValidator $validator, CompanyInterface $company) {
        $this->validator = $validator;
        $this->company = $company;
    }

    public function save(array $data){
        if ( ! $this->valid($data) ) return false;



        if ( empty ($data['companyId']) ) {
            // сохранить
            $data['user_id'] = userId();

            $this->company->create($data);

        } else {
            //обновить
            $companyId = $data['companyId'];
            unset($data['companyId']);
            unset($data['_token']);

            $this->company->update($data, $companyId);
            return true;
        }
    }

    public function update(array $data){
        if ( ! $this->valid($data) ) return false;
    }

    public function bindProfile(array $data){
        if ( ! $this->valid($data) ) return false;
    }
    public function unbindProfile(array $data){
        if ( ! $this->valid($data) ) return false;
    }

    public function bindSupplier(array $data){
        if ( ! $this->valid($data) ) return false;
    }
    public function unbindSupplier(array $data){
        if ( ! $this->valid($data) ) return false;
    }

}