<?php

namespace App\Models\Customers;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'name',
        'surname',
        'email',
        'phone',
        'external_user_id',
        'company_id'
    ];

    public function getFullnameAttribute(): string
    {
        return "{$this->name} {$this->surname}";
    }
}
