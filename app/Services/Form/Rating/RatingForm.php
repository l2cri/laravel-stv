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
use App\Services\Form\FormTrait;
use App\Services\Validation\ValidableInterface;
use Auth;

class RatingForm
{

    use FormTrait;

    protected $validator;
    protected $rating;

    public function __construct(ValidableInterface $validator,ProductInterface $rating)
    {
        $this->validator = $validator;
        $this->rating = $rating;
    }

    public function rateProduct($input)
    {

        if ( ! $this->valid($input) ) return false;


        return $this->rating->rate($input['rateable_id'],$input['rate']);
    }
}