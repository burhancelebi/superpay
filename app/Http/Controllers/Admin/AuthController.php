<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Users\ResetPasswordRequest;
use App\Services\Users\UserServiceInterface;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;

class AuthController extends Controller
{
    protected UserServiceInterface $userService;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    public function showLoginForm(): Factory|Application|View
    {
        return view('admin.auth.login');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = $this->userService->findByEmail($request->get('email'));

            if (!$user->isActive()) {
                return back()
                    ->withErrors(['email' => 'You cannot log in to the system because your account is not active.'])
                    ->withInput();
            }

            return redirect()->route('admin.backoffice');
        }

        return back()->withErrors(['email' => 'Email veya şifre hatalı.'])->withInput();
    }

    public function logout(): RedirectResponse
    {
        Auth::logout();

        return redirect()->route('admin.login.form');
    }

    /**
     * @return View|Application|Factory
     */
    public function showLinkRequestForm(): View|Application|Factory
    {
        return view('admin.auth.passwords.email');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function sendResetLinkEmail(Request $request): RedirectResponse
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink($request->only('email'));

        return $status === Password::RESET_LINK_SENT
            ? back()->with('status', 'success')->with('alert', 'Kayıtlı e-posta adresinize şifre sıfırlama e-postası gönderdik.
Lütfen gelen kutunuzu kontrol edin ve talimatları izleyerek şifrenizi sıfırlayın.')
            : back()->withErrors(['email' => __($status)]);
    }

    /**
     * @param $token
     * @return View|Application|Factory
     */
    public function showResetForm($token): View|Application|Factory
    {
        return view('admin.auth.passwords.reset', ['token' => $token]);
    }

    /**
     * @param ResetPasswordRequest $request
     * @return RedirectResponse
     */
    public function reset(ResetPasswordRequest $request): RedirectResponse
    {
        $reset = DB::table('password_reset_tokens')->where('email', $request->get('email'))->first();

        if (!$reset || !Hash::check($request->get('token'), $reset->token)) {
            return back()->withErrors(['email' => 'Geçersiz veya süresi bitmiş token.']);
        }

        $this->userService->updatePassword($reset->email, $request->get('password'));
        DB::table('password_reset_tokens')->where('email', $reset->email)->delete();

        return redirect()->route('admin.login.form')
            ->with('status', 'success')
            ->with('alert', 'Password has been reset successfully.');
    }
}


















