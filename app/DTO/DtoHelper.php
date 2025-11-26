<?php

namespace App\DTO;

trait DtoHelper
{
    abstract public function toArray(): array;

    /**
     * @return array
     */
    public function onlyFilled(): array
    {
        $inputKeys = array_keys(request()->all());
        $dtoArray = $this->toArray();

        return array_intersect_key($dtoArray, array_flip($inputKeys));
    }
}
