<?php

namespace App\Services\Util;

/** third party */
use Illuminate\Support\Facades\Storage;
/** my library */
use App\Services\Service;

class StorageService extends Service
{

    /**
     * @param $picture
     * @param string $file_path
     * @param string $file_name
     * @return false|string
     */
    public static function setPicture($picture, string $file_path, string $file_name)
    {
        $file = $picture->getClientOriginalName();
        $extension = pathinfo($file, PATHINFO_EXTENSION);
        $file_name = $file_name . ".${extension}";

        $path = Storage::putFileAs($file_path, $picture, $file_name);
        $path =  basename($path);

        return $path;
    }
}
