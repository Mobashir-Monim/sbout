<?php

namespace App\Helpers\Utilities\Uploaders;

use App\Helpers\Helper;
use Storage;

class ImageUploader extends Helper
{
    protected $image_path;

    public function __construct($file, $path, $storage = 'local')
    {
        Storage::disk($storage)->makeDirectory("public/$path", 'public');
        $file_name = explode('.', request()->file($file)->getClientOriginalName())[0] . time() . "." . request()->file($file)->extension();
        request()->$file->storePubliclyAs("public/$path", $file_name, $storage);

        $this->image_path = "$path/$file_name";
    }

    public function getImagePath()
    {
        return $this->image_path;
    }
}