<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ImageService
{
    /**
     * @var string
     */
    private string $destination;

    /**
     * @var string
     */
    private string $name;

    /**
     * @var UploadedFile
     */
    private UploadedFile $request;

    /**
     * @var ImageManager
     */
    private ImageManager $image;

    /**
     * @var int
     */
    private int $size_X;

    /**
     * @var int
     */
    private int $size_Y;

    public function __construct(UploadedFile $request)
    {
        $this->image = new ImageManager(new Driver());
        $this->request = $request;

        $this->name = $request->getClientOriginalName();
        $imageSize = getimagesize($request);
        $this->size_X = $imageSize[0];
        $this->size_Y = $imageSize[1];
    }

    /**
     * @param int $width
     * @param int $height
     * @return void
     */
    public function resize(int $width, int $height): void
    {
        $this->size_X = $width;
        $this->size_Y = $height;
    }

    /**
     * @return string
     */
    public function getDestination(): string
    {
        return $this->destination;
    }

    /**
     * @param string $destination
     * @return $this
     */
    public function setDestination(string $destination): ImageService
    {
        $this->destination = $destination;

        return $this;
    }

    /**
     * @param string $dateDestination
     */
    public function setDestinationWithDate(string $dateDestination): void
    {
        $date = Carbon::now();

        $year = $date->year;
        $month = $date->month;

        $folder = $dateDestination . $year;

        if (!file_exists($folder))
            mkdir($folder);

        $folder .= '/' . $month . '/';

        if (!file_exists($folder))
            mkdir($folder);

        $this->setDestination($folder);
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName(string $name): ImageService
    {
        $this->name = $name;

        return $this;
    }

    public function save(): void
    {
        $this->image
            ->read($this->request)
            ->resize($this->size_X, $this->size_Y)
            ->save($this->getDestination() . $this->getName());
    }

    /**
     * @param string $title
     * @return void
     */
    public function setNameByTitle(string $title): void
    {
        $title = Str::slug($title);
        $this->setName( $title. '-' . rand(0, 99999999) . '.' . $this->request->getClientOriginalExtension());
    }
}
