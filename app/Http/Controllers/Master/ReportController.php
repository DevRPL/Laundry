<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Entities\Transaction;
use App\Entities\User;
use Illuminate\Http\Request;
use App\Exports\EntryOrderExport;
use Auth;
use Carbon\Carbon;
use App\Services\Contracts\TransactionServiceContract;

class ReportController extends Controller
{
    protected $transaction;

    public function __construct(TransactionServiceContract $transaction)
    {
        $this->transaction = $transaction;
    }

    public function reportDataOrder(Request $request)
    {
        $entry_orders = $this->transaction->getReportDataOrder(
            $request->start_date .' '.'00:00:00', $request->end_date .' '.'23:59:59'
        );
        
        return view('admin.report.report_order', compact('entry_orders'));
    }

    public function exportEntryOrder(Request $request)
    {
        return (new EntryOrderExport($request->start_date, $request->end_date))
            ->download('Periode ' . $request->start_date . ' Sampai ' . $request->end_date . '.xlsx');
    }
}