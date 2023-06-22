<?php

namespace App\Services;

use App\Entities\Customer;
use App\Entities\User;
use App\Services\Contracts\CustomerServiceContract;
use Auth;

class CustomerService implements CustomerServiceContract
{
    protected $customer;
    
    public function __construct(Customer $customer) 
    {
        $this->customer = $customer;
    }
    
    public function all()
    {
        return $this->customer->all();
    }

    public function getAllByBranch()
    {
        return Customer::whereHas("user", function($q){
            $q->where("branch_id", Auth::user()->branch_id);
         })->get();
    }

    public function getAllAndPaginate($limit = 10, $params = [])
    {
        return $this->customer->orderBy('id', 'desc')
            ->paginate($limit);
    }
    
    public function find($id)
    {
        return $this->customer->find($id);
    }
    
    public function create(array $attributes)
    {
        return $this->customer->create($attributes);
    }
    
    public function update(array $attributes, $id)
    {
        return $this->customer->find($id)->update($attributes);
    }
    
    public function delete($id)
    {
        return $this->customer->find($id)->delete($id);
    }
}