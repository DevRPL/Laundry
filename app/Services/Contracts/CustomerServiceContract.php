<?php
namespace App\Services\Contracts;
/**
 * Interface CustomerServiceContract.
 */
interface CustomerServiceContract extends BaseServiceContract
{
    public function getAllByBranch();
}