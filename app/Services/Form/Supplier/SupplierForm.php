<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 08.04.16
 * Time: 19:37
 */

namespace App\Services\Form\Supplier;


use App\Repo\Supplier\SupplierInterface;
use App\Services\Form\FormTrait;
use App\Services\Validation\ValidableInterface;

class SupplierForm
{
    protected $supplier;
    protected $validator;
    protected $currentSupplier;

    use FormTrait;

    public function __construct(ValidableInterface $validableInterface, SupplierInterface $supplierInterface){
        $this->supplier = $supplierInterface;
        $this->validator = $validableInterface;

        $this->currentSupplier = $this->supplier->byId(supplierId());
    }

    public function update(array $input) {
        if (!$this->valid($input)) return false;

        unset($input['profileId']);
        unset($input['_token']);

        if (array_key_exists('logo', $input)){
            $input['logo'] = $this->processLogo($input['logo']);
        }

        if (array_key_exists('logo_store', $input)){
            $input['logo_store'] = process_upload_file($input['logo_store'],
                $this->currentSupplier->logo_store, config('marketplace.supplierDir'));
        }

        $this->supplier->update($input, supplierId());
        return true;
    }

    protected function processLogo($logo) {

        if (is_null($logo) || empty($logo)) return;

        $imgFile = uploadFileToMultipleDirs( $logo, config('marketplace.supplierDir') );

        $currentLogo = $this->supplier->byId(supplierId())->logo;
        removefile($currentLogo);

        return $imgFile;
    }
}