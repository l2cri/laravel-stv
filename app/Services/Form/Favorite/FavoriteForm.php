<?php
/**
 * Created by PhpStorm.
 * User: l2cri
 * Date: 08.04.16
 * Time: 13:55
 */

namespace App\Services\Form\Favorite;


use App\Repo\Favorite\FavoriteInterface;
use App\Services\Form\FormTrait;
use App\Services\Validation\ValidableInterface;
use Auth;

class FavoriteForm
{
    use FormTrait;

    protected $data;
    protected $validator;
    protected $favorite;

    public function __construct(ValidableInterface $validator,FavoriteInterface $favorite){
        $this->validator = $validator;
        $this->favorite = $favorite;
    }



    public function FavoriteProduct($input)
    {
        $user_id = (int) Auth::user()->id;
        $product_id = (int) $input['id'];

        if($this->favorite->checkUnique($user_id,$product_id)) return false;

        if ( ! $this->valid(['user_id'=>$user_id,'product_id'=>$product_id]) ) return false;

        return $this->favorite->set($product_id,$user_id);
    }
}