<?php

namespace App\Services\Customers;

use App\DTO\Customers\CustomerDTO;
use App\Models\Merchants\Merchant;
use App\Models\Customer;
use App\Repositories\Customers\CustomerRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class CustomerService implements CustomerServiceInterface
{
    protected CustomerRepositoryInterface $customerRepository;

    public function __construct(CustomerRepositoryInterface $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    /**
     * @param Merchant $company
     * @return LengthAwarePaginator
     */
    public function getByCompanyId(Merchant $company): LengthAwarePaginator
    {
        return $this->customerRepository->getByCompanyId($company->id);
    }

    /**
     * @param CustomerDTO $customerDTO
     * @return Customer
     */
    public function create(CustomerDTO $customerDTO): Customer
    {
        return $this->customerRepository->create($customerDTO);
    }

    /**
     * @param int $id
     * @return Customer|null
     */
    public function findById(int $id): ?Customer
    {
        return $this->customerRepository->findById($id);
    }

    /**
     * @param int $externalUserId
     * @return Customer|null
     */
    public function findByExternalId(int $externalUserId): ?Customer
    {
        return $this->customerRepository->findByExternalId($externalUserId);
    }
}
