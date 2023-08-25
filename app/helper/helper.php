<?php

use App\Models\Designation;
use App\Models\User;
use Carbon\Carbon;
use Hashids\Hashids;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
function uploadImageWithBase64($fileName, $path = '')
{
    $name = "default.png";
    if ($fileName) {
        $time = time();
        // Base64 To Image Convert
        $fileNameParts = explode(';', $fileName);
        if (count($fileNameParts) >= 2) {
            list($type, $image) = $fileNameParts;
            list(, $image) = explode(',', $image);
            $file = base64_decode($image);
            $name = $time . '.png';

            // Save the original image
            $filePath = $path . '/' . $name;
            $fullPath = base_path();
            $filePath = str_replace("src", $filePath, $fullPath);
            $img = Image::make($file);
            $img->resize(800, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($filePath);
        } else { }
    }
    return $name;
}


