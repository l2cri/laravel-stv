<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 03.03.16
 * Time: 13:59
 */

namespace App\Http\Controllers;


use App\Repo\Profile\ProfileInterface;
use App\Services\Form\Profile\ProfileForm;
use Illuminate\Http\Request;

class ProfileController extends Controller
{

    protected $profile;
    protected $form;

    public function __construct(ProfileInterface $profile, ProfileForm $form){
        $this->profile = $profile;
        $this->form = $form;
    }

    public function index() {
        return view('panel.user.profiles.index');
    }

    public function add(Request $request){
        $input = removeEmptyValues($request->all());

        if ($this->form->save($input)) {
            return response("profile added");
        } else {
            return response("profile added")
                    ->withErrors($this->form->errors())
                    ->with('status', 'error');
        }


    }
}