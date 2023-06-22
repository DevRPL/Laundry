<?php
namespace App\Services\Contracts;

interface BaseServiceContract
{
    public function all();

    public function getAllAndPaginate($limit = 10, $params = []);
    
    public function find($id);
    
    public function create(array $attributes);
    
    public function update(array $attributes, $id);
    
    public function delete($id);
}