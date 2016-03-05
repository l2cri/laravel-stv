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
use Auth;

class ProfileController extends Controller
{

    protected $profile;
    protected $form;
    protected $userId;

    public function __construct(ProfileInterface $profile, ProfileForm $form){
        $this->profile = $profile;
        $this->form = $form;
        $this->userId = Auth::user()->id;
    }

    public function index() {
        $profiles = $this->profile->findAllBy('user_id', $this->userId);
        return view('panel.user.profiles.index', compact('profiles'));
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

    public function update(Request $request) {
        $input = removeEmptyValues($request->all());

        if ($this->form->update($input)) {
            return response("профиль отредактирован");
        } else {
            return response("профиль не сохранен")
                ->withErrors($this->form->errors())
                ->with('status', 'error');
        }
    }

    public function show($id) {
        $profile = $this->profile->byId($id);
        return view('panel.user.profiles.show', compact('profile'));
    }

    public function updateform($id){
        $profile = $this->profile->byId($id);
        return view('panel.user.profiles.update', compact('profile'));
    }
}