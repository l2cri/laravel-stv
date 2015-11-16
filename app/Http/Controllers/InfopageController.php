<?php

namespace App\Http\Controllers;

use App\Repo\Infopage\InfopageInterface;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class InfopageController extends Controller
{
    protected $infopage;

    public function __construct(InfopageInterface $infopage){
        $this->infopage = $infopage;
    }

    public function byCode($code){
        $infopage = $this->infopage->byCode($code);
        return view('content.infopage', compact('infopage'));
    }
}
