<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 09.04.16
 * Time: 14:49
 */

namespace App\Repo\Company;


use App\Repo\RepoInterface;

interface CompanyInterface extends RepoInterface
{
    public function getByUserId($userId);
    public function bindProfile($profileId, $companyId);
    public function unbindProfile($profileId);
    public function bindSupplier($supplierId, $companyId);
    public function unbindSupplier($supplierId, $companyId);
}