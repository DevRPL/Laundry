<?php

namespace App\Services;

use App\Entities\Package;
use App\Entities\User;
use App\Services\Contracts\LaundryPackageContract;
use Auth;

class LaundryPackageService implements LaundryPackageContract
{
    protected $package;
    
    public function __construct(Package $package) 
    {
        $this->package = $package;
    }
    
    public function all()
    {
        return $this->package->all();
    }

    public function getAllAndPaginate($limit = 10, $params = [])
    {
        return $this->package->orderBy('id', 'desc')
            ->paginate($limit);
    }
    
    public function getAllByBranch()
    {
        return Package::whereHas("user", function($q){
            $q->where("branch_id", Auth::user()->branch_id);
         })->get();
    }

    public function find($id)
    {
        return $this->package->find($id);
    }
    
    public function create(array $attributes)
    {
        return $this->package->create($attributes);
    }
    
    public function update(array $attributes, $id)
    {
        return $this->package->find($id)->update($attributes);
    }
    
    public function delete($id)
    {
        return $this->package->find($id)->delete($id);
    }
}