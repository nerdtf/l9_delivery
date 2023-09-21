<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class ImageService {

    /**
     * Store the uploaded image and return its filename.
     *
     * @param $image UploadedFile instance or path.
     * @return string
     */
    public function storeImage($image): string
    {
        $uuid = str()->uuid();
        $extension = $image->extension();
        $filename = "{$uuid}.{$extension}";

        Storage::disk('public')->putFileAs('client_images', $image, $filename);

        return $filename;
    }

    /**
     * Delete the image by its filename.
     *
     * @param string $filename
     * @return void
     */
    public function deleteImage(string $filename): void
    {
        Storage::disk('public')->delete('client_images/' . $filename);
    }

}
