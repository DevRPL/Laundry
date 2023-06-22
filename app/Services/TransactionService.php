<?php

namespace App\Services;

use App\Entities\Transaction;
use App\Entities\User;
use App\Services\Contracts\TransactionServiceContract;
use Auth;

class TransactionService implements TransactionServiceContract
{
    protected $transction;
    
    public function __construct(Transaction $transction) 
    {
        $this->transction = $transction;
    }
    
    public function all()
    {
        return $this->transction->all();
    }

    public function getAllAndPaginate($limit = 10, $params = [])
    {
        return $this->transction->orderBy('id', 'desc')
            ->paginate($limit);
    }

    public function getAllByBranch()
    {
        return Transaction::whereHas("user", function($q){
            $q->where("branch_id", Auth::user()->branch_id);
         })->get();
    }
    
    public function find($id)
    {
        return $this->transction->find($id);
    }
    
    public function create(array $attributes)
    {
        return $this->transction->create($attributes);
    }

    public function update(array $attributes, $id)
    {
        return $this->transction->find($id)->update($attributes);
    }

    public function delete($id) 
    {
        //
    }

    public function getTransactionlast()
    {
        return $this->transction->orderBy('id', 'desc');
    }

    public function getStatusLaundry($date, $param)
    {
         return $this->transction->whereHas("user", function($q){
                $q->where("branch_id", Auth::user()->branch_id);
             })->where('created_at', '>=', $date)
               ->where('status_order', $param)->count();
    }

    public function getReportDataOrder($start_date, $end_date)
    {
        return Transaction::whereHas("user", function($q){
            $q->where("branch_id", Auth::user()->branch_id);
        })->whereBetween(
            'created_at', [
                $start_date, $end_date
            ]
        )->whereIn('status_order', ['Selesai', 'Ambil'])
            ->OrderBy('created_at', 'ASC')->get();
 
    }
}