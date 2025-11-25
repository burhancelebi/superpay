<?php

namespace App\Services\Settings;

use App\Http\Requests\Admin\Settings\SettingStoreRequest;
use App\Models\Setting;
use Illuminate\Database\Eloquent\Collection;

interface SettingServiceInterface
{
    public function settings(): Collection;
    public function create(SettingStoreRequest $request): Setting;
    public function findById(int $id): Setting;
    public function getSettingByKey(string $key): ?Setting;
    public function getSettings(array $keys): array;

}
