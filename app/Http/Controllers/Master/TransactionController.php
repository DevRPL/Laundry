<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Entities\Customer;
use App\Entities\Package;
use Illuminate\Http\Request;
use App\Services\Contracts\TransactionServiceContract;
use App\Services\Contracts\CustomerServiceContract;
use App\Services\Contracts\LaundryPackageContract;
use Illuminate\Support\Facades\Auth;
use PDF;

class TransactionController extends Controller
{
    protected $transaction;
    protected $customer;
    protected $package;

    public function __construct(
        TransactionServiceContract $transaction,
        CustomerServiceContract $customer,
        LaundryPackageContract $package
    ) {
        $this->transaction = $transaction;
        $this->customer = $customer;
        $this->package = $package;
    }

    public function index()
    {
        $transactions = $this->transaction->getAllByBranch();

        return view('admin.transaction.index', compact('transactions'));
    }

    public function create()
    {
        $orderLast = $this->transaction->getTransactionlast()->first();
        $numberOld = isset($orderLast) ? preg_replace('/[^0-9]+/', '', $orderLast->order_number) : 0;
        $numberNew = 'ORD-' . str_pad($numberOld + 1, 6, '0', STR_PAD_LEFT);
        $customers = $this->customer->all();
        $packages = $this->package->all();

        return view('admin.transaction.create', compact(
                'numberNew', 'customers', 'packages'
            )
        );
    }

    public function store(Request $request)
    {
        $data = $request->all();
        
        $request->merge([
            'user_id' => Auth::user()->id
        ]);

        if ($data['registration'] == 1) { 
            $this->transaction->create(
                $request->except(
                    [
                        'name','address','phone', 
                        'registration', 'gender'
                    ]
                )
            );

            return redirect()->route('master.transaksis.index');
        } else {
            $customer = $this->customer->create(
                $request->only(
                    [
                        'name', 'phone', 'address', 
                        'gender', 'user_id'
                    ]
                )
            );
            
            $this->transaction->create([
                'order_number' => $data['order_number'],
                'customer_id' => $customer->id,
                'package_id' => $data['package_id'],
                'price' => $data['price'],
                'weight' => $data['weight'],
                'total' => $data['total'],
                'date_take' => $data['date_take'],
                'status' => $data['status'],
                'description' => $data['description'],
                'user_id' => $request->user_id
            ]);

            return redirect()->route('master.transaksis.index');
        }
    }
    
    public function show($id)
    {   
        $transaction = $this->transaction->find($id);
        
        return view('admin.transaction.show', compact('transaction'));
    }

    public function updateStatus(Request $request, $id)
    {
        $data = $request->all();
        
        $data['user_id'] = Auth::user()->id;

        $this->transaction->update($data, $id);
        
        return redirect()->route('master.transaksis.index');
    }

    public function get($id)
    {
        return json_encode(Customer::where('id', $id)->get());
    }

    public function getPackage($id)
    {
        return json_encode(Package::where('id', $id)->get());
    }

    public function printInvoice($id)
    {   
        $transaction = $this->transaction->find($id);
        
        return PDF::loadView('admin.transaction.print', compact('transaction'))
            ->setPaper('A4', 'potrait')
            ->stream('customers.pdf');
    }
}
