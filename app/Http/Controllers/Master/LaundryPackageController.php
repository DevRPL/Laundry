<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Services\Contracts\LaundryPackageContract;
use Illuminate\Http\Request;
use Auth;

class LaundryPackageController extends Controller
{
    protected $package;

    public function __construct(LaundryPackageContract $package)
    {
        $this->package = $package;
    }

    public function index()
    {
        $packages = $this->package->getAllByBranch();
        
        return view('admin.package.index', compact('packages'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        
        $data['user_id'] = Auth::user()->id; 
        
        $this->package->create($data);
        
        return redirect()->route('master.pakets.index');
    }

    public function edit($id)
    {
        $package = $this->package->find($id);

        return view('admin.package.edit', compact('package'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        
        $data['user_id'] = Auth::user()->id; 

        $this->package->update($data, $id);
        

        return redirect()->route('master.pakets.index');
    }

    public function destroy($id)
    {
        $this->package->delete($id);

        return redirect()->back();
    }
}