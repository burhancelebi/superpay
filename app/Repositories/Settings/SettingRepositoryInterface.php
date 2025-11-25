<?php

namespace App\Repositories\Settings;

use App\Models\Setting;
use Illuminate\Database\Eloquent\Collection;

interface SettingRepositoryInterface
{
    public function settings(): Collection;
    public function create(array $data):  Setting;
    public function update(string $key, $value): Setting;
    public function findById(int $id): Setting;

    public function getSettingByKey(string $key): ?Setting;

    public function getSettings(array $keys): array;
}
