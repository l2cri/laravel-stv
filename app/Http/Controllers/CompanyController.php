<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 09.04.16
 * Time: 18:06
 */

namespace App\Http\Controllers;


use App\Repo\Company\CompanyInterface;
use App\Services\Form\Company\CompanyForm;
use Illuminate\Http\Request;
use Redirect;

class CompanyController extends Controller
{
    protected $company;
    protected $form;

    public function __construct( CompanyInterface $company, CompanyForm $form ){
        $this->company = $company;
        $this->form = $form;
    }

    public function company(){
        $company = $this->company->getByUserId( userId() );
        return view('panel.user.company', compact('company'));
    }

    public function save(Request $request) {
        $input = removeEmptyValues($request->all());

        if ($this->form->save( $input ) ){
            return Redirect::to( route('panel::company') )->with('status', 'success');
        } else {
            return Redirect::to( route('panel::company') )->withInput()
                ->withErrors( $this->form->errors() )
                ->with('status', 'error');
        }
    }
}
