<?php

namespace App\Http\Controllers;

use App\Repo\Banners\BannerInterface;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{

    protected $banners;

    public function __construct(BannerInterface $banner){
        $this->banners = $banner;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $banners = $this->banners->sortable('sort','asc');
        $rightBanners  = $this->banners->sortable('sort','asc','right');
        return view('home',compact('banners','rightBanners'));
    }
}
