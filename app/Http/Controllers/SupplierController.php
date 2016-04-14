<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 06.04.16
 * Time: 18:16
 */

namespace App\Http\Controllers;


use App\Repo\Action\ActionInterface;
use App\Repo\Comment\CommentInterface;
use App\Repo\Product\ProductInterface;
use App\Repo\Section\SectionInterface;
use App\Repo\Supplier\SupplierInterface;
use App\Repo\Criteria\Product\MinMaxPrice;
use App\Repo\Criteria\Product\SuppliersOnly;
use App\Services\Form\Rating\RatingForm;
use App\Services\Form\Supplier\SupplierForm;
use App\StaticHelpers\ProductHelper;
use Illuminate\Http\Request;
use Redirect;
use Mail;

class SupplierController extends Controller
{
    protected $product;
    protected $section;
    protected $supplier;
    protected $form;

    public function __construct(ProductInterface $product, SectionInterface $section,
                                SupplierInterface $supplier, SupplierForm $form){
        $this->section = $section;
        $this->product = $product;
        $this->supplier = $supplier;
        $this->form = $form;
    }

    public function catalog($name, $code = null) {

        if ($code) $currentSection = $this->section->byCode($code);

        $supplier = $this->supplier->byCode($name);
        $sections = $this->section->bySupplier($supplier->id);

        // назначаем поставщика
        $this->product->pushCriteria( new SuppliersOnly([$supplier->id]) );

        // вытаскиваем товары по категориям
        if (isset($currentSection) && !empty($currentSection)) {
            $sectionIds = [$currentSection->id];
        } else $sectionIds = $sections->lists('id')->all();
        $products = $this->product->bySectionIds( $sectionIds );

        $maxProductPrice = ProductHelper::maxProductPrice($this->product->allProductsFromLastRequest());

        $prefix = $this->product->prefix();

        return view('supplier.index', compact('products', 'sections', 'currentSection',
            'maxProductPrice', 'supplier', 'prefix'));
    }

    public function ajax(Request $request, $name){

        $supplier = $this->supplier->byCode($name);

        if ($request->input('sectionId')) $currentSection = $this->section->byCode($request->input('sectionId'));

        // фильтр по цене
        if ($request->has('minprice') && $request->has('maxprice')) {
            $this->product->pushCriteria( new MinMaxPrice($request->input('minprice'), $request->input('maxprice')));
        }

        // назначаем поставщика всегда
        $this->product->pushCriteria( new SuppliersOnly([$supplier->id]) );

        // секции - одна или много
        if (isset($currentSection) && !empty($currentSection))
            $products = $this->product->bySection($currentSection->id, false);
        else $products = $this->product->bySupplierPaginate($supplier->id);

        $prefix = $this->product->prefix();

        return view('catalog.ajaxindex', compact('products', 'currentSection', 'prefix'));
    }

    public function settings(){
        $supplier = $this->supplier->byId(supplierId());
        return view('panel.supplier.settings', compact('supplier'));
    }

    public function updateSettings(Request $request) {
        $input = removeEmptyValues($request->all());

        if ($request->hasFile('logo')) {
            $input['logo'] = $request->file('logo');
        }

        if ($this->form->update( $input ) ){
            return Redirect::to( route('panel::supplier.settings') )->with('status', 'success');
        } else {
            return Redirect::to( route('panel::supplier.settings') )->withInput()
                ->withErrors( $this->form->errors() )
                ->with('status', 'error');
        }
    }

    /**
     * Каталог поставщиков
     */
    public function suppliers($sectionCode = null)
    {

        $sectionsPotreb = $this->section->getTree(config('marketplace.potrebSectionId'));
        $sectionsProm = $this->section->getTree(config('marketplace.promSectionId'));

        if ($sectionCode) {
            $currentSection = $this->section->byCode($sectionCode);
            $this->product->bySection($currentSection->id);
            $suppliers = $this->supplier->byProductsPaginate($this->product->allProductsFromLastRequest());

            // определеяем текущая секция где
            if (in_array($currentSection->id, $sectionsPotreb->pluck('id')->all()) ||
                ($currentSection->id == config('marketplace.potrebSectionId'))
            )
                $currentSectionPotreb = $currentSection;

            if (in_array($currentSection->id, $sectionsProm->pluck('id')->all()) ||
                ($currentSection->id == config('marketplace.promSectionId'))
            )
                $currentSectionProm = $currentSection;

        } else $suppliers = $this->supplier->allPaginate();

        $mainRoute = route('suppliers');
        $prefix = $this->supplier->prefix();

        return view('suppliers.index', compact('suppliers', 'sectionsPotreb', 'sectionsProm',
            'currentSectionPotreb', 'currentSectionProm', 'mainRoute', 'prefix'));
    }

    public function rateSupply(Request $request,RatingForm $ratingForm,$id)
    {
        $request->merge(array('rateable_id' => $id));
        $input = removeEmptyValues($request->all());

        if ($ratingForm->rateSupplier($input) ){
            $item = $this->supplier->byId($id);
            return response()->json(['rating' => $item['rating'], 'status' => 'OK']);
        }
        else{
            $errors = $ratingForm->errors();
            return response()->json(['errors' => $errors, 'status' => 'ERROR']);
        }
    }

    public function comments($name,CommentInterface $commentsInterfafe){

        $supplier = $this->supplier->byCode($name);
        $comments = $commentsInterfafe->commentsBySupplier($supplier);
        $routeName = 'commentSupplier';

        return view('supplier.comments',compact('comments','supplier','routeName'));
    }

    public function about($name){
        $supplier = $this->supplier->byCode($name);

        return view('supplier.about',compact('supplier'));
    }

    public function contacts($name){
        $supplier = $this->supplier->byCode($name);

        return view('supplier.contacts',compact('supplier','send'));
    }

    public function feedback(Request $request,$name){

        $supplier = $this->supplier->byCode($name);
        $errors =[];

        if($request->message){
            $send = Mail::raw($request->message, function($message) use ($supplier,$request)
            {
                $userEmail = userField('email');
                $userName = ($request->name)? $request->name: userField('name');

                $message->from($userEmail, $userName);

                $message->to($supplier->user->email);
            });

            if($send){
                return Redirect::to( route('supplier.feedback',['name'=>$name]) )->withInput()
                    ->with('message', 'Ваше письмо отправлено.');
            }else{
                $errors[] = 'Почтовая служба не настроена';
            }


        }else{
            $errors[] = 'Не введено вообщение.';
        }

        return Redirect::to( route('supplier.feedback',['name'=>$name]) )->withInput()
            ->withErrors( $errors )
            ->with('status', 'error');
    }


    public function actions($name, ActionInterface $actionInterface){
        $supplier = $this->supplier->byCode($name);
        $news = $actionInterface->pagenatebleBySupplier($supplier);

        return view('supplier.actions',compact('supplier','news'));
    }
}