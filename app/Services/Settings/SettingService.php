<?php

namespace App\Services\Settings;

use App\Http\Requests\Admin\Settings\LogoRequest;
use App\Http\Requests\Admin\Settings\SettingStoreRequest;
use App\Models\Setting;
use App\Repositories\Settings\SettingRepositoryInterface;
use App\Services\ImageService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

class SettingService implements SettingServiceInterface
{
    const SETTING_IMAGE_PATH = 'assets/media/logos/';
    private SettingRepositoryInterface $settingRepository;

    public function __construct(SettingRepositoryInterface $settingRepository)
    {
        $this->settingRepository = $settingRepository;
    }

    /**
     * @return Collection
     */
    public function settings(): Collection
    {
        return $this->settingRepository->settings();
    }

    /**
     * @param SettingStoreRequest $request
     * @return Setting
     */
    public function create(SettingStoreRequest $request): Setting
    {
        return $this->settingRepository->create($request->validated());
    }

    /**
     * @param int $id
     * @return Setting
     */
    public function findById(int $id): Setting
    {
        return $this->settingRepository->findById($id);
    }

    /**
     * @param string $key
     * @return Setting|null
     */
    public function getSettingByKey(string $key): ?Setting
    {
        return $this->settingRepository->getSettingByKey($key);
    }

    /**
     * @param array $keys
     * @return array
     */
    public function getSettings(array $keys): array
    {
        return $this->settingRepository->getSettings($keys);
    }

    /**
     * @param LogoRequest $request
     * @return void
     */
    public function updateLogo(LogoRequest $request): void
    {
        $this->settingRepository->update('logo-title', $request->get('logo-title'));

        if ($request->has('logo-image'))
        {
            $this->removeImage('logo-image');
            $this->saveImage($request->file('logo-image'), 'logo-image',
                $request->get('logo-title'));
        }
    }

    /**
     * @param UploadedFile $request
     * @param string $key
     * @param string $title
     * @return void
     */
    private function saveImage(UploadedFile $request, string $key, string $title): void
    {
        $saveImage = new ImageService($request);
        $saveImage->setDestination(self::SETTING_IMAGE_PATH);
        $saveImage->setNameByTitle($title);
        $saveImage->save();

        $this->settingRepository->update($key, $saveImage->getDestination() . $saveImage->getName());
    }

    /**
     * @param Request $request
     * @return Setting
     */
    public function updateTitle(Request $request): Setting
    {
        return $this->settingRepository->update('site-title', $request->get('site-title'));
    }

    /**
     * @param string $key
     * @return void
     */
    private function removeImage(string $key): void
    {
        $imageName = $this->settingRepository->getSettingByKey($key);

        if (file_exists(public_path($imageName->value)) AND $imageName->value != "")
            unlink(public_path($imageName->value));
    }
}
