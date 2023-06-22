<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $guarded = [];
    
    protected $table = 'laundry_packages';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
