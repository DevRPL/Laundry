<?php

namespace App\Services;

use App\Entities\Branch;
use App\Services\Contracts\BranchServiceContract;

class BranchService implements BranchServiceContract
{
    protected $branch;
    
    public function __construct(Branch $branch) 
    {
        $this->branch = $branch;
    }
    
    public function all()
    {
        return $this->branch->all();
    }

    public function getAllAndPaginate($limit = 10, $params = [])
    {
        return $this->branch->orderBy('id', 'desc')
            ->paginate($limit);
    }
    
    public function find($id)
    {
        return $this->branch->find($id);
    }
    
    public function create(array $attributes)
    {
        return $this->branch->create($attributes);
    }
    
    public function update(array $attributes, $id)
    {
        return $this->branch->find($id)->update($attributes);
    }
    
    public function delete($id)
    {
        return $this->branch->find($id)->delete($id);
    }
}