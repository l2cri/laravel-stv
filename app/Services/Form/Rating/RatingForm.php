<?php
/**
 * Created by PhpStorm.
 * User: l2cri
 * Date: 06.04.16
 * Time: 17:44
 */

namespace App\Services\Form\Rating;

use App\Repo\Product\ProductInterface;
use App\Repo\RatingRepoTrait;
use App\Repo\Supplier\SupplierInterface;
use App\Services\Form\FormTrait;
use App\Services\Validation\ValidableInterface;
use Auth;

class RatingForm
{

    use FormTrait;

    protected $validator;
    protected $product;
    protected $supplier;

    public function __construct(ValidableInterface $validator,ProductInterface $product, SupplierInterface $supplier )
    {
        $this->validator = $validator;
        $this->product = $product;
        $this->supplier = $supplier;
    }

    public function rateProduct($input)
    {

        if ( ! $this->valid($input) ) return false;


        return $this->product->rate($input['rateable_id'],$input['rate']);
    }

    public function rateSupplier($input)
    {
        if ( ! $this->valid($input) ) return false;


        return $this->supplier->rate($input['rateable_id'],$input['rate']);
    }
}