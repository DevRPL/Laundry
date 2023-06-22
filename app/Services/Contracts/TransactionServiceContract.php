<?php
namespace App\Services\Contracts;
/**
 * Interface TransactionServiceContract.
 */
interface TransactionServiceContract extends BaseServiceContract
{
    public function getAllByBranch();

    public function getStatusLaundry($date, $param);

    public function getReportDataOrder($start_date, $end_date);
}