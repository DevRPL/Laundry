<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Services\Contracts\BranchServiceContract;
use Illuminate\Http\Request;
use Auth;

class BranchController extends Controller
{
    protected $branch;

    public function __construct(BranchServiceContract $branch)
    {
        $this->branch = $branch;
    }

    public function index()
    {
        $branches = $this->branch->all();
        
        return view('admin.branch.index', compact('branches'));
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $this->branch->create($data);
        
        return redirect()->route('master.cabangs.index');
    }

    public function edit($id)
    {
        $branch = $this->branch->find($id);

        return view('admin.branch.edit', compact('branch'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        
        $this->branch->update($data, $id);
        
        return redirect()->route('master.cabangs.index');
    }

    public function destroy($id)
    {
        if ($id == Auth::user()->branch_id) {
            return redirect()->back()
                ->with(['error' => 'Cabang Penempatan Anda Tidak Bisa Dihapus']);
        }

        $this->branch->delete($id);

        return redirect()->back();
    }
}