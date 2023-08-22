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
            $img = Image::make($file);
            $img->resize(800, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path($filePath));

            // // Save the thumbnail
            // $thumbFilePath = $path . '/thumb/' . $name;
            // $thumbImg = Image::make($file);
            // $thumbImg->resize(100, null, function ($constraint) {
            //     $constraint->aspectRatio();
            // })->save(public_path($thumbFilePath));
        } else {
            // Handle the case when $fileName does not contain the expected data
            // Log an error, throw an exception, or handle it as appropriate for your application
            // For example:
            // Log::error("Invalid data format in \$fileName: " . $fileName);
            // throw new Exception("Invalid data format in \$fileName");
        }
    }
    return $name;
}


