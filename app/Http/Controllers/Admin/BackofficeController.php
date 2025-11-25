<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Artisan;

class BackofficeController extends Controller
{
    /**
     * @return Factory|Application|View
     */
    public function index(): Factory|Application|View
    {
        return view('admin.index');
    }

    /**
     * @param string $status
     * @return Application|RedirectResponse|Redirector
     */
    public function maintenance(string $status): Application|RedirectResponse|Redirector
    {
        if ($status == 'down') {
            $passKey = 'bypass-key';
            Artisan::call('down', ['--secret' => $passKey]);

            return redirect("/$passKey");
        }

        Artisan::call('up');
        return redirect()->route("admin.backoffice");
    }
}
