<?php

namespace App\Providers;

use App\Repositories\Customers\CustomerRepository;
use App\Repositories\Customers\CustomerRepositoryInterface;
use App\Repositories\Settings\SettingRepository;
use App\Repositories\Settings\SettingRepositoryInterface;
use App\Repositories\Tasks\TaskRepository;
use App\Repositories\Tasks\TaskRepositoryInterface;
use App\Repositories\Users\Banks\UserBankRepository;
use App\Repositories\Users\Banks\UserBankRepositoryInterface;
use App\Repositories\Users\UserRepository;
use App\Repositories\Users\UserRepositoryInterface;
use App\Services\Customers\CustomerService;
use App\Services\Customers\CustomerServiceInterface;
use App\Services\Settings\SettingService;
use App\Services\Settings\SettingServiceInterface;
use App\Services\Tasks\TaskService;
use App\Services\Tasks\TaskServiceInterface;
use App\Services\Users\Banks\UserBankService;
use App\Services\Users\Banks\UserBankServiceInterface;
use App\Services\Users\UserService;
use App\Services\Users\UserServiceInterface;
use App\Repositories\Wallets\WalletRepository;
use App\Repositories\Wallets\WalletRepositoryInterface;
use App\Services\Wallets\WalletService;
use App\Services\Wallets\WalletServiceInterface;
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

        WalletServiceInterface::class => WalletService::class,
        WalletRepositoryInterface::class => WalletRepository::class,

        TaskServiceInterface::class => TaskService::class,
        TaskRepositoryInterface::class => TaskRepository::class,
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
