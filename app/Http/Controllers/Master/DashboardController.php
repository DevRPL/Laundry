<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Services\Contracts\TransactionServiceContract;
use Carbon\Carbon;
use App\Entities\Transaction;
use Auth;

class DashboardController extends Controller
{
    protected $transaction;

    public function __construct(TransactionServiceContract $transaction) {
        $this->transaction = $transaction;
    }

    public function index()
    {
        $status_process = $this->transaction
            ->getStatusLaundry(Carbon::today()->toDateTimeString(), 'Proses');

        $status_take = $this->transaction
            ->getStatusLaundry(Carbon::today()->toDateTimeString(), 'Ambil');
        
        $status_done = $this->transaction
            ->getStatusLaundry(Carbon::today()->toDateTimeString(), 'Selesai');
              
        $customer_new = Transaction::whereHas("user", function($q){
                $q->where("branch_id", Auth::user()->branch_id);
             })->where('created_at', '>=', Carbon::today()->toDateTimeString())->count();
   
       return view('admin.dashboard.index', compact(
          'status_process',
          'status_take',
          'status_done',
          'customer_new'
       ));
    }
}
