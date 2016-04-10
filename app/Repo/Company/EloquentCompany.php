<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 09.04.16
 * Time: 14:51
 */

namespace App\Repo\Company;


use App\Repo\RepoTrait;
use Illuminate\Database\Eloquent\Model;

class EloquentCompany implements CompanyInterface
{
    use RepoTrait;

    protected $model;
    protected $profile;
    protected $supplier;

    public function __construct(Model $model, Model $profile, Model $supplier) {
        $this->model = $model;
        $this->profile = $profile;
        $this->supplier = $supplier;
    }

    public function getByUserId($userId)
    {
        $company = $this->model->where('user_id', '=', $userId)->first();
        if (! $company) return $this->model;

        return $company;
    }

    public function bindProfile($profileId, $companyId)
    {
        $profile = $this->profile->find($profileId);
        $this->model->find($companyId)->profiles()->save($profile);
    }

    public function unbindProfile($profileId)
    {
        $this->profile->find($profileId)->company()->dissociate()->save(); // обязательно save - видимо глюк
    }

    public function bindSupplier($supplierId, $companyId)
    {
        $supplier = $this->supplier->find($supplierId);
        $this->model->find($companyId)->supplier()->associate($supplier)->save();
    }

    public function unbindSupplier($supplierId, $companyId)
    {
        $this->model->find($companyId)->supplier()->dissociate()->save();
    }
}