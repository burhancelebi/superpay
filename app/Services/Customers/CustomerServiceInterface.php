<?php

namespace App\Services\Customers;

use App\DTO\Customers\CustomerDTO;
use App\Models\Merchants\Merchant;
use App\Models\Customer;
use Illuminate\Pagination\LengthAwarePaginator;

interface CustomerServiceInterface
{
    public function getByCompanyId(Merchant $company): LengthAwarePaginator;
    public function create(CustomerDTO $customerDTO): Customer;
    public function findById(int $id): ?Customer;
    public function findByExternalId(int $externalUserId): ?Customer;
}
