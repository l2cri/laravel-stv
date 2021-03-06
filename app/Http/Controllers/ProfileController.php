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
use Redirect;

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
            return response()->json( ['errors' => $this->form->errors()], 500 );
        }
    }

    public function update(Request $request) {
        $input = removeEmptyValues($request->all());

        if ($this->form->update($input)) {
            return response("профиль отредактирован");
        } else {
            return redirect()->back()
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

    public function delete($id){
        $this->profile->delete($id);
        return Redirect::to(route('panel::profiles'));
    }

    public function setLocation(Request $request){

        $this->validate($request, [
            'location_id' => 'required|numeric',
            'profileId' => 'required|numeric',
        ]);

        $profile = $this->profile->byId($request->get('profileId'));
        if ($profile->user->id == $this->userId){
            $input['location_id'] = $request->get('location_id');
            $this->profile->update($input, $request->get('profileId'));
        }
    }
}