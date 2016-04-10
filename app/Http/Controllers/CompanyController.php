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
}
