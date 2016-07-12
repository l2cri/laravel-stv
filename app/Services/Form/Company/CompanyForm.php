<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 09.04.16
 * Time: 16:36
 */

namespace App\Services\Form\Company;


use App\Repo\Company\CompanyInterface;
use App\Repo\Profile\ProfileInterface;
use App\Repo\Supplier\SupplierInterface;
use App\Services\Form\FormTrait;
use App\Services\Validation\AbstractLaravelValidator;

class CompanyForm
{
    protected $validator;
    protected $company;
    protected $profile;
    protected $supplier;
    protected $fileDir;

    use FormTrait;

    public function __construct(AbstractLaravelValidator $validator, CompanyInterface $company,
                                    ProfileInterface $profile, SupplierInterface $supplier) {
        $this->validator = $validator;
        $this->company = $company;
        $this->profile = $profile;
        $this->supplier = $supplier;
        $this->fileDir = config('marketplace.company_dir');
    }

    public function save(array $data){
        if ( ! $this->valid($data) ) return false;

        if ( empty ($data['companyId']) ) {
            // сохранить
            $data['user_id'] = userId();

            if (array_key_exists('stamp', $data)){
                $data['stamp'] = process_upload_file($data['stamp'], false, $this->fileDir);
            }

            $this->company->create($data);

        } else {
            //обновить
            $companyId = $data['companyId'];
            unset($data['companyId']);
            unset($data['_token']);

            if (!array_key_exists('nds', $data)) $data['nds'] = 0;

            if (array_key_exists('stamp', $data)){
                $company = $this->company->byId($companyId);
                $data['stamp'] = process_upload_file($data['stamp'], $company->stamp, $this->fileDir);
            }

            $this->company->update($data, $companyId);
            return true;
        }
    }

    public function toggleProfile($profileId, $userId) {

        $company = $this->company->getByUserId($userId);

        $profile = $this->profile->byId($profileId);
        if ($profile->company_id == $company->id) {
            // отвязать
            $this->company->unbindProfile($profileId);
        } else {
            // привязать
            $this->company->bindProfile($profileId, $company->id);
        }
    }

    public function toggleSupplier($supplierId, $userId) {
        $company = $this->company->getByUserId($userId);
        $supplier = $this->supplier->byId($supplierId);

        if ( $company->supplier_id == $company->id ){
            $this->company->unbindSupplier($supplierId, $company->id);
        } else $this->company->bindSupplier($supplierId, $company->id);
    }

}