<?php

namespace App\Repositories\Customers;

use App\DTO\Customers\CustomerDTO;
use App\Models\Customer;
use Illuminate\Pagination\LengthAwarePaginator;

class CustomerRepository implements CustomerRepositoryInterface
{
    protected Customer $model;

    public function __construct(Customer $model)
    {
        $this->model = $model;
    }

    /**
     * @param int $companyId
     * @return LengthAwarePaginator
     */
    public function getByCompanyId(int $companyId): LengthAwarePaginator
    {
        return $this->model->newQuery()
            ->where('company_id', $companyId)
            ->when(request()->filled('email'), function ($query) {
                $query->where('email', request()->input('email'));
            })
            ->paginate(21);
    }


    /**
     * @param CustomerDTO $customerDTO
     * @return Customer
     */
    public function create(CustomerDTO $customerDTO): Customer
    {
        return $this->model->newQuery()->firstOrCreate([
            'company_id' => $customerDTO->company_id,
            'external_user_id' => $customerDTO->external_user_id,
        ], $customerDTO->toArray());
    }

    /**
     * @param int $id
     * @return Customer|null
     */
    public function findById(int $id): ?Customer
    {
        return $this->model->newQuery()->find($id);
    }

    /**
     * @param int $externalUserId
     * @return Customer|null
     */
    public function findByExternalId(int $externalUserId): ?Customer
    {
        return $this->model->newQuery()->where('external_user_id', $externalUserId)->first();
    }

}
