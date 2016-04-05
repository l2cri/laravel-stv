<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 21.01.16
 * Time: 2:30
 */

namespace App\Services\Form\Product;

use App\Repo\Action\ActionInterface;
use App\Repo\Product\ProductInterface;
use App\Services\Validation\ValidableInterface;
use Auth;
use App\Models\Product\Photo;

class ProductForm
{
    protected $validator;
    protected $product;
    protected $action;

    public function __construct(ValidableInterface $validator, ProductInterface $product, ActionInterface $action){
        $this->validator = $validator;
        $this->product = $product;
        $this->action = $action;
    }

    public function save(array $input) {

        if ( ! $this->valid($input) ) return false;

        $input['regular_price'] = $input['price'];
        $input['supplier_id'] = $this->getSupplierId();

        $product = $this->product->create($input);
        $product->sections()->attach($input['section_ids']);

        if (array_key_exists('photos', $input)){

            $files = $this->upload($input['photos']);
            $product->photos()->createMany($files);
        }

        return $product;
    }

    public function update(array $input) {
        if ( ! $this->valid($input) ) return false;

        $input['regular_price'] = $input['price'];
        $productId = $input['product_id'];
        $photos = $input['photos'];
        $sectionsIds = $input['section_ids'];

        unset($input['product_id']);
        unset($input['_token']);
        unset($input['photos']);
        unset($input['section_ids']);

        $this->product->update($input, $productId);
        /*
         * добавление акции и расчет акционной цены
         */
        if (!empty($input['action_id']))
            $this->action->applyOne($input['action_id'], $productId);

        $product = $this->product->byId($productId);

        if(is_array($sectionsIds)) {
            $product->sections()->detach();
            $product->sections()->attach($sectionsIds);
        }

        if (is_array($photos)){
            $files = $this->upload($photos);
            $product->photos()->createMany($files);
        }

        return $product;
    }

    public function fakeSave(array $input){

        if ( ! $this->valid($input) ) return false;
        $files = $this->upload($input['photos']);

        for ($i = 1; $i <= 30; $i++){

            $input['price'] = $input['price'] + $i*10;
            $input['regular_price'] = $input['price'];
            $input['supplier_id'] = $this->getSupplierId();

            $input['name'] = $input['name'].$i;

            $product = $this->product->create($input);
            $product->sections()->attach($input['section_ids']);

            $product->photos()->createMany($files);
        }

        return true;
    }

    // TODO: перенести функцию в хелпер какой-нибудь
    protected function upload($photos){
        $files = array();

        foreach ($photos as $photo) {

            if (is_null($photo)) continue;

            $value = uploadFileToMultipleDirs($photo, config('marketplace.productPhotoDir'));

            $files[] = array(
                'file' => $value
            );
        }
        return $files;
    }

    public function errors() {
        return $this->validator->errors();
    }

    protected function valid(array $input){
        return $this->validator->with($input)->passes();
    }

    /**
     * Проверяет, является ли текущий пользователь поставщиком этого товара
     * @return bool
     */
    protected function isValidSupplier($supplierId){

        $suppliers = Auth::user()->suppliers;
        $filtered = $suppliers->where('id', $supplierId);

        if (count($filtered->all() > 0)) return true;

        return false;
    }

    /**
     * Возвращает айди поставщика если он явно в форме не указан - сделано с учетом будующих требований,
     * когда один пользователь сможет иметь несколько компаний на аккаунте
     * @return mixed
     */
    protected function getSupplierId(){
        return Auth::user()->suppliers[0]->id;
    }

    public function deleteimg($id){
        removefile(Photo::find($id)->file);
        Photo::destroy($id);
    }

    public function delete($id){
        $this->product->delete($id);
    }
}