<?php

namespace App\Http\Controllers;

use App\Repo\News\NewsInterface;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class NewsController extends Controller
{
    protected $news;
    //
    public function __construct(NewsInterface $news)
    {
        $this->news = $news;
    }

    public function index()
    {
        $news = $this->news->getList();

        return view('news.index',compact('news'));
    }
    public function byId($id)
    {
        if($post = $this->news->byId($id))
            return view('news.detail',compact('post'));
        else
            \App::abort(404);
    }
}
