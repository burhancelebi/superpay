<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Settings\LogoRequest;
use App\Http\Requests\Admin\Settings\SettingStoreRequest;
use App\Http\Requests\Admin\Settings\SettingUpdateRequest;
use App\Services\Settings\SettingServiceInterface;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    private SettingServiceInterface $settingService;

    public function __construct(SettingServiceInterface $settingService)
    {
        $this->settingService = $settingService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): Factory|Application|View
    {
        $settings = $this->settingService->settings();

        return view('admin.settings.index',  compact('settings'));
    }

    /**
     * @param LogoRequest $request
     * @return Application|Factory|View|RedirectResponse
     */
    public function logo(LogoRequest $request): Application|Factory|View|RedirectResponse
    {
        if ($request->isMethod('PUT'))
        {
            $this->settingService->updateLogo($request);

            return redirect()->route('admin.settings.logo')
                ->with('alert', 'Logo updated successfully')
                ->with('status', 'success');
        }

        $settings = $this->settingService->getSettings([
            'logo-title', 'logo-image'
        ]);

        return view('admin.settings.logo', compact('settings'));
    }

    /**
     * @param Request $request
     * @return Application|Factory|View|RedirectResponse
     */
    public function siteTitle(Request $request): Application|Factory|View|RedirectResponse
    {
        if ($request->isMethod('PUT'))
        {
            $this->settingService->updateTitle($request);

            return redirect()->route('admin.settings.site_title')
                ->with('alert', 'Title updated successfully')
                ->with('status', 'success');
        }

        $settings = $this->settingService->getSettings(['site-title']);

        return view('admin.settings.site_title', compact('settings'));
    }
}
