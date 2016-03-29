<?php

namespace App\Http\Controllers;

use App\Repo\Comment\CommentInterface;
use App\Services\Form\Comment\CommentForm;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

class CommentController extends Controller
{
    protected $comment;
    protected $input;
    protected $id;
    protected $commentForm;

    function __construct(CommentInterface $comment, CommentForm $commentForm){
        $this->comment = $comment;
        $this->commentForm = $commentForm;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$id)
    {
        //
        $errors = '';

        $request->merge(array('id' => $id));
        $input = removeEmptyValues($request->all());

        if ($this->commentForm->save($input) ){
            $status = 'success';
        } else {
            $status = 'error';
            $errors = $this->commentForm->errors();
        }

        $comments = $this->comment->byProductId($id);

        return view('comments.list',compact('comments','id','status','errors'));
    }

    public function paginator($id){

        $comments = $this->comment->byProductId($id);
        return view('comments.list', compact('comments','id'));
    }
    /**
     * Store a newly created resource in storage with redirect.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeWithRedirect(Request $request,$id)
    {
        //
        $request->merge(array('id' => $id));
        $input = removeEmptyValues($request->all());
        if ($this->commentForm->save($input) ){
            return Redirect::to( route('product.page',['id'=>$id]) )->with('status', 'success');
        } else {
            return Redirect::to( route('product.page',['id'=>$id]) )->withInput()
                ->withErrors( $this->commentForm->errors() )
                ->with('status', 'error');
        }
    }
}
