<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 28.12.15
 * Time: 20:45
 */

namespace App\Http\Controllers;


use App\Repo\Section\SectionInterface;
use App\Services\Form\Section\SectionForm;
use Redirect;
use Input;

class SectionController extends Controller
{
    protected $section;
    protected $sectionForm;

    public function __construct(SectionInterface $section, SectionForm $sectionForm){
        $this->sectionForm = $sectionForm;
        $this->section = $section;
    }

    /*
     * GET panel/supplier/sections/ - здесь будут категории и возможность создать новую
     */
    public function index(){
        return view('panel.supplier.sections');
    }

    /*
     * POST panel/supplier/section/store - создать новую категорию
     */
    public function store(){
        if ($this->sectionForm->save(Input::all()) ){
            return Redirect::to( route('panel::sections') )->with('status', 'success');
        } else {
            return Redirect::to( route('panel::sections') )->withInput()
                    ->withErrors( $this->sectionForm->errors() )
                    ->with('status', 'error');
        }

    }

    /*
     * GET panel/supplier/section/delete/{id} - удаление категории, которая еще не промодерирована
     */
}