<?php


use App\Models\Setting;
use App\Services\Settings\SettingServiceInterface;

foreach (glob(__DIR__ . '/**/*.php') as $file) {
    require_once $file;
}

function getSettingByKey(string $key): ?Setting
{
    return app(SettingServiceInterface::class)->getSettingByKey($key);
}



