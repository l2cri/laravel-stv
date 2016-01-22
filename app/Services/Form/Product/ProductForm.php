<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 21.01.16
 * Time: 2:30
 */

namespace App\Services\Form\Product;

use App\Repo\Product\ProductInterface;
use App\Services\Validation\ValidableInterface;
use Auth;
use Symfony\Component\HttpFoundation\File\UploadedFile;


class ProductForm
{
    protected $data;
    protected $validator;
    protected $product;

    public function __construct(ValidableInterface $validator, ProductInterface $product){
        $this->validator = $validator;
        $this->product = $product;
    }

    public function save(array $input) {

        if ( ! $this->valid($input) ) return false;

        $input['regular_price'] = $input['price'];
        $input['supplier_id'] = $this->getSupplierId();

        $product = $this->product->create($input);
        $product->sections()->attach($input['section_ids']);

        if (array_key_exists('photos', $input)){

            $files = $this->upload($input['photos']);
            //  var_dump($files); die();
            $product->photos()->createMany($files);
        }

        return $product;
    }

    // TODO: перенести функцию в хелпер какой-нибудь
    protected function upload($photos){
        $files = array();

        foreach ($photos as $photo) {

            if (is_null($photo)) continue;

            $filename = md5(time() . $photo->getClientOriginalName()) . '.' . $photo->getClientOriginalExtension();
            $path = config('marketplace.productPhotoDir');
            $fullpath = public_path($path);
            $photo->move($fullpath, $filename);
            $value = $path . '/' . $filename;

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
}