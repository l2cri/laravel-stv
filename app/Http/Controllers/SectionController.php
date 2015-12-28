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

class SectionController extends Controller
{
    protected $section;
    protected $sectionForm;

    public function __construct(SectionInterface $section, SectionForm $sectionForm){
        $this->$section = $section;
        $this->sectionForm = $sectionForm;
    }

    /*
     * GET panel/supplier/sections/ - здесь будут категории и возможность создать новую
     */

    /*
     * POST panel/supplier/section/store - создать новую категорию
     */

    /*
     * GET panel/supplier/section/delete/{id} - удаление категории, которая еще не промодерирована
     */
}