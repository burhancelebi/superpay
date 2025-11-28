<?php

namespace App\Http\Controllers\Frontend;

use App\DTO\Users\UserBankDTO;
use App\DTO\Users\UserDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\LoginRequest;
use App\Http\Requests\Frontend\RegisterRequest;
use App\Services\Users\Banks\UserBankServiceInterface;
use App\Services\Users\UserServiceInterface;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Throwable;

class AuthController extends Controller
{
    protected UserServiceInterface $userService;
    private UserBankServiceInterface $userBankService;

    public function __construct(UserServiceInterface $userService, UserBankServiceInterface $userBankService)
    {
        $this->userService = $userService;
        $this->userBankService = $userBankService;
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

            if (!Auth::user()->isActive()) {

                Auth::logout();
                request()->session()->invalidate();

                return back()->withErrors([
                    'email' => 'Hesabınız sistemde aktif olmadığından dolayı giriş yapamazsınız.',
                ])->onlyInput('email');
            }

            $request->session()->regenerate();

            return redirect()->intended(route('home'));
        }

        return back()->withErrors([
            'email' => 'Girdiğiniz bilgiler kayıtlarımızla eşleşmiyor.',
        ])->onlyInput('email');
    }

    /**
     * @param RegisterRequest $request
     * @return JsonResponse
     * @throws Throwable
     */
    public function register(RegisterRequest $request): JsonResponse
    {
        try {
            DB::beginTransaction();
            $data['password'] = Hash::make($request->get('password'));
            $userDto = UserDTO::from([
                ...$request->validated(),
                'password' => $data['password'],
            ]);

            $user = $this->userService->create($userDto);

            foreach ($request->input('bank_name', []) as $index => $bankName)
            {
                $bankDTO = new UserBankDTO(
                    user_id: $user->id,
                    bank_name: $bankName,
                    iban: $request->get('iban')[$index]
                );

                $this->userBankService->create($bankDTO);
            }

            DB::commit();
            Auth::login($user);

            return response()->json(['status' => 'success',
                'message' => 'Kayıt işlemi başarıyla tamamlandı.']);

        } catch (Throwable $exception) {
            DB::rollBack();
            return response()->json(['status' => 'error', 'message' => $exception->getMessage()]);
        }
    }

    public function logout(): RedirectResponse
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect()->route('auth.login');
    }
}
