<?php

namespace App\Repositories\Customers;

use App\DTO\Customers\CustomerDTO;
use App\Models\Customer;
use Illuminate\Pagination\LengthAwarePaginator;

interface CustomerRepositoryInterface
{
    public function getByCompanyId(int $companyId): LengthAwarePaginator;
    public function create(CustomerDTO $customerDTO): Customer;
    public function findById(int $id): ?Customer;
    public function findByExternalId(int $externalUserId): ?Customer;
}
