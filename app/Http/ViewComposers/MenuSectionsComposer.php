<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 18.01.16
 * Time: 15:48
 */

namespace App\Http\ViewComposers;

use App\Repo\Section\SectionInterface;
use Illuminate\View\View;

class MenuSectionsComposer
{
    protected $sections;

    public function __construct(SectionInterface $sections)
    {
        $this->sections = $sections;
    }

    public function compose(View $view)
    {
        $view->with('promSections', $this->sections->getTree(config('marketplace.promSectionId')))
             ->with('potrebSections', $this->sections->getTree(config('marketplace.potrebSectionId')));
    }
}