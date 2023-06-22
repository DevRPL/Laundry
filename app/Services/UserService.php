<?php

namespace App\Services;

use App\Entities\User;
use App\Services\Contracts\UserServiceContract;
use Auth;

class UserService implements UserServiceContract
{
    protected $user;
    
    public function __construct(User $user) 
    {
        $this->user = $user;
    }
    
    public function all()
    {
        return $this->user->all();
    }

    public function getAllByBranch()
    {
        return $this->user->where('branch_id', Auth::user()->branch_id)
            ->get();
    }

    public function getAllAndPaginate($limit = 10, $params = [])
    {
        return $this->user->orderBy('id', 'desc')
            ->paginate($limit);
    }
    
    public function find($id)
    {
        return $this->user->find($id);
    }
    
    public function create(array $attributes)
    {
        return $this->user->create($attributes);
    }

    public function update(array $attributes, $id)
    {
        return $this->user->find($id)->update($attributes);
    }

    public function delete($id)
    {
        return $this->user->find($id)->delete($id);
    }
}