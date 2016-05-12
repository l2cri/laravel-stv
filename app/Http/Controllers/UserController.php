<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 12.05.16
 * Time: 16:51
 */

namespace App\Http\Controllers;


use App\Repo\User\UserInterface;
use App\Services\Form\User\UserForm;
use Illuminate\Http\Request;
use Redirect;

class UserController extends Controller
{
    protected $user;
    protected $form;

    public function __construct(UserInterface $user, UserForm $form){
        $this->user = $user;
        $this->form = $form;
    }

    public function update(Request $request){
        $input = removeEmptyValues($request->all());

        if ($this->form->update( $input ) ){
            return Redirect::to( route('panel::account') )->with('status', 'success');
        } else {
            return Redirect::to( route('panel::account') )->withInput()
                ->withErrors( $this->form->errors() )
                ->with('status', 'error');
        }
    }

    public function index(){
        $user = $this->user->byId( userId() );
        return view('panel.user.account', compact('user'));
    }
}