<?php

namespace App\Providers;

use App\Repositories\Customers\CustomerRepository;
use App\Repositories\Customers\CustomerRepositoryInterface;
use App\Repositories\Settings\SettingRepository;
use App\Repositories\Settings\SettingRepositoryInterface;
use App\Repositories\Users\Banks\UserBankRepository;
use App\Repositories\Users\Banks\UserBankRepositoryInterface;
use App\Repositories\Users\UserRepository;
use App\Repositories\Users\UserRepositoryInterface;
use App\Services\Customers\CustomerService;
use App\Services\Customers\CustomerServiceInterface;
use App\Services\Settings\SettingService;
use App\Services\Settings\SettingServiceInterface;
use App\Services\Users\Banks\UserBankService;
use App\Services\Users\Banks\UserBankServiceInterface;
use App\Services\Users\UserService;
use App\Services\Users\UserServiceInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public $bindings = [
        SettingServiceInterface::class => SettingService::class,
        SettingRepositoryInterface::class => SettingRepository::class,

        UserServiceInterface::class => UserService::class,
        UserRepositoryInterface::class => UserRepository::class,

        CustomerServiceInterface::class => CustomerService::class,
        CustomerRepositoryInterface::class => CustomerRepository::class,

        UserBankServiceInterface::class => UserBankService::class,
        UserBankRepositoryInterface::class => UserBankRepository::class,
    ];

    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
