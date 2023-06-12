<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait HasCustomModel
{
    public function makeImageUrl($image, $pathSource)
    {
        //Check if $image is a URL or not, and then return data accordingly
        $image = $this->attributes['image'];
        return filter_var($image, FILTER_VALIDATE_URL)
        ? $image
        : secure_asset(Storage::url($pathSource . $image));
    }

    public function makeFileUrl($file, $pathSource)
    {
        $file = $this->attributes['file'];
        return secure_asset(Storage::url($pathSource . $file));
    }

    public function getFullNameAttribute()
    {
        return
        $this->attributes['last_name'] . ' ' . $this->attributes['first_name']
        ;
    }

    public function getShortNameAttribute()
    {
        return
        $this->attributes['last_name'] . ' ' . $this->convertNameToInitials($this->attributes['first_name'])
        ;
    }

    public function convertNameToInitials($firstName)
    {
        $nameParts = explode(' ', $firstName);

        if (count($nameParts) > 1) {
            $firstNameInitial = mb_substr($nameParts[0], 0, 1, 'UTF-8');
            $lastNameInitial = mb_substr($nameParts[1], 0, 1, 'UTF-8');
            return $firstNameInitial . '.' . $lastNameInitial . '.';
        } else if (count($nameParts) > 0) {
            $firstNameInitial = mb_substr($nameParts[0], 0, 1, 'UTF-8');
            return $firstNameInitial . '.';
        } else {
            return '';
        }
    }
}
