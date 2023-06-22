<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\Exportable;

class EntryOrderExport implements FromView, WithEvents, ShouldAutoSize
{
    use Exportable;

    protected $start_date;

    protected $end_date;

    public function __construct($start_date, $end_date)
    {
        $this->start_date = $start_date;
        $this->end_date = $end_date;
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $headCustomer = [
                    'font' => [
                        'bold' => false,
                    ],
                ];
                $event->sheet->getStyle('A5:A7')->applyFromArray($headCustomer);
            },
        ];
    }
    
    /**
    * @return \Illuminate\Support\Collection
    */
    
    public function view(): View
    {
        $transaction = app('App\Services\Contracts\TransactionServiceContract');

        $entry_orders = $transaction->getReportDataOrder(
            $this->start_date .' '.'00:00:00' ?? '', $this->end_date .' '.'23:59:59' ?? ''
        );
        
        $periode = [
            'start_date' => $this->start_date,
            'end_date' => $this->end_date
        ];
        
        return view(
            'admin.report.excel.report-entry-order', compact('entry_orders', 'periode')
        );
    }
}
