<?php

namespace App\Repositories\Settings;

use App\Models\Setting;
use Illuminate\Database\Eloquent\Collection;

class SettingRepository implements SettingRepositoryInterface
{
    private Setting $model;

    public function __construct(Setting $setting)
    {
        $this->model = $setting;
    }

    /**
     * @return Collection
     */
    public function settings(): Collection
    {
        return $this->model->all();
    }

    /**
     * @param array $data
     * @return Setting
     */
    public function create(array $data): Setting
    {
        return $this->model->newQuery()->create($data);
    }

    /**
     * @param string $key
     * @param $value
     * @return Setting
     */
    public function update(string $key, $value): Setting
    {
        $setting = $this->model->newQuery()->where('key', $key)->first();
        $setting->value = $value;
        $setting->save();

        return $setting;
    }

    /**
     * @param int $id
     * @return Setting
     */
    public function findById(int $id): Setting
    {
        return $this->model->newQuery()->where('id', $id)->first();
    }

    /**
     * @param string $key
     * @return Setting|null
     */
    public function getSettingByKey(string $key): ?Setting
    {
        return $this->model->newQuery()->where('key', $key)->first();
    }

    /**
     * @param array $keys
     * @return array
     */
    public function getSettings(array $keys): array
    {
        $settings = [];

        foreach ($keys as $key)
        {
            $settings[$key] = $this->getSettingByKey($key);
        }

        return $settings;
    }
}
