<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Services\Users\Banks\UserBankServiceInterface;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    public function __construct(private UserBankServiceInterface $userBankService)
    {
    }

    public function profile(Request $request)
    {
        $user = auth()->user();

        return view('frontend.users.profile', compact('user'));
    }

    public function transactions(Request $request)
    {
        $user = auth()->user();

        return view('frontend.users.transactions', compact('user'));
    }

    /**
     * @param Request $request
     * @return Factory|\Illuminate\Contracts\View\View|View
     */
    public function paymentMethods(Request $request)
    {
        $methods = $this->userBankService->getByUserId(auth()->id());
        $user = auth()->user();

        return view('frontend.users.payment-methods', compact('methods', 'user'));
    }
}
