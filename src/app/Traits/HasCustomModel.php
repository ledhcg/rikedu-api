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

    public function getFullNameAttribute()
    {
        return
        $this->attributes['last_name'] . ' ' . $this->attributes['first_name']
        ;
    }
}
