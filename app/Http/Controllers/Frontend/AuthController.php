<?php

namespace App\Http\Controllers\Frontend;

use App\DTO\UserDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\LoginRequest;
use App\Http\Requests\Frontend\RegisterRequest;
use App\Services\Users\UserServiceInterface;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    protected UserServiceInterface $userService;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Giriş sayfasını gösterir.
     */
    public function showLoginForm(): Factory|Application|View
    {
        return view('frontend.auth.login');
    }

    /**
     * Kayıt sayfasını gösterir.
     */
    public function showRegisterForm(): Factory|Application|View
    {
        return view('frontend.auth.register');
    }

    /**
     * @param LoginRequest $request
     * @return RedirectResponse
     */
    public function login(LoginRequest $request): RedirectResponse
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            return redirect()->intended(route('home'));
        }

        return back()->withErrors([
            'email' => 'Girdiğiniz bilgiler kayıtlarımızla eşleşmiyor.',
        ])->onlyInput('email');
    }

    /**
     * @param RegisterRequest $request
     * @return RedirectResponse
     */
    public function register(RegisterRequest $request): RedirectResponse
    {
        $data['password'] = Hash::make($request->get('password'));
        $userDto = UserDTO::from([
            ...$request->validated(),
            'password' => $data['password'],
        ]);

        $user = $this->userService->create($userDto);
        Auth::login($user);

        return response()->json(['status' => 'success',
            'message' => 'Kayıt işlemi başarıyla tamamlandı.']);
    }

    public function logout(): RedirectResponse
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect()->route('login');
    }
}
