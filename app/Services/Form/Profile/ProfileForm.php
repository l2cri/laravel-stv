<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 04.03.16
 * Time: 11:12
 */

namespace App\Services\Form\Profile;


use App\Repo\Profile\ProfileInterface;
use App\Services\Form\FormTrait;
use App\Services\Validation\ValidableInterface;
use Auth;

class ProfileForm
{
    use FormTrait;

    protected $profile;
    protected $validator;
    protected $userId;

    public function __construct(ValidableInterface $validator, ProfileInterface $profile) {
        $this->profile = $profile;
        $this->validator = $validator;
        $this->userId = Auth::user()->id;
    }

    public function save(array $input) {
        if ( ! $this->valid($input) ) return false;

        $input['user_id'] = $this->userId;
        $this->profile->create($input);
        return true;
    }
}