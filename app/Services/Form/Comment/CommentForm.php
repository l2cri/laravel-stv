<?php
/**
 * Created by PhpStorm.
 * User: Unizoo5
 * Date: 25.03.2016
 * Time: 18:52
 */

namespace App\Services\Form\Comment;


use App\Services\Validation\ValidableInterface;
use App\Repo\Comment\CommentInterface;
use Auth;

class CommentForm
{

    protected $data;
    protected $validator;
    protected $comment;

    public function __construct(ValidableInterface $validator,CommentInterface $comment){
        $this->validator = $validator;
        $this->comment = $comment;
    }

    public function save(array $input) {

        $input['user_id'] = (int) Auth::user()->id;

        if ( ! $this->valid($input) ) return false;

        return $this->comment->create($input);
    }

    public function save4Supplier(array $input) {

        $input['user_id'] = (int) Auth::user()->id;

        if ( ! $this->valid($input) ) return false;

        return $this->comment->create4Supplier($input);
    }

    public function errors() {
        return $this->validator->errors();
    }

    protected function valid(array $input){
        return $this->validator->with($input)->passes();
    }

    public function toggle($id){
        $comment = $this->comment->byId($id);

        $comment->moderated = ($comment->moderated == 1) ? 0 : 1;

        return $comment->save();
    }

}