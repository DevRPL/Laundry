<?php
namespace App\Services\Contracts;
/**
 * Interface UserManagementServiceContract.
 */
interface UserServiceContract extends BaseServiceContract
{
    public function getAllByBranch();
}