<?php

namespace App\Http\Controllers\Master;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Entities\User;
use App\Entities\Branch;
use App\Services\Contracts\UserServiceContract;
use Hash;
use Auth;

class UserController extends Controller
{
    protected $user;

    public function __construct(UserServiceContract $user)
    {
        $this->user = $user;
    }
    
    public function index()
    {
        $users = $this->user->getAllByBranch();
        
        return view('admin.user.index', compact('users'));
    }
    
    public function create()
    {
        $branches = Branch::all();

        return view('admin.user.create', compact('branches'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'same:confirm-password'
        ]);

        $data = $request->all();
        
        $data['password'] = Hash::make($data['password']);

        $this->user->create($data);

        return redirect()->route('master.users.index');
    }
    
    public function show($id)
    {
        $user = $this->user->find($id);

        return view('admin.user.show',compact('user'));
    }
    
    public function edit($id)
    {
        $user =  $this->user->find($id);

        return view('admin.user.edit',compact('user'));
    }
    
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'same:confirm-password'
        ]);

        $data = $request->all();
        
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            $data = array_except($data, array('password'));
        }

        $this->user->update($data, $id);

        return redirect()->route('master.users.index');
    }

    public function destroy($id)
    {
        if ($id == Auth::user()->id) {
            return redirect()->back()
                ->with(['error' => 'Pengguna Yang Sedang Login Tidak Bisa Dihapus']);
        }

        $this->user->delete($id);
        
        return redirect()->route('master.users.index');
    }
}