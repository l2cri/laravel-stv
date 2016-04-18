<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 13.04.16
 * Time: 18:54
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Repo\Location\LocationInterface;
use App\Services\Form\Location\LocationForm;

class LocationController extends Controller
{
    protected $location;
    protected $form;

    public function __construct(LocationInterface  $location, LocationForm $form) {
        $this->location = $location;
        $this->form = $form;
    }

    public function locationsTree() {
        $locationTree = $this->location->getTree( config('marketplace.locationLevel') );
        $supplierLocations = $this->location->getBySupplier(supplierId());
        return view('panel.supplier.locationtree', compact('locationTree', 'supplierLocations'));
    }

    public function saveDeliveryZone(Request $request){

        $input = removeEmptyValues($request->all());

        if ($this->form->saveDeliveryZone( $input, supplierId() ) ){
            return Redirect::to( route('panel::location.zones') )->with('status', 'success');
        } else {
            return Redirect::to( route('panel::location.zones') )->withInput()
                ->withErrors( $this->form->errors() )
                ->with('status', 'error');
        }
    }

    public function ajax(Request $request){
        return $this->location->getJson($request->get('id'), supplierId());
    }
}