<?php
namespace App\Services\Contracts;
/**
 * Interface LaundryPackageContract.
 */
interface LaundryPackageContract extends BaseServiceContract
{
    public function getAllByBranch();
}