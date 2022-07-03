<?php 

namespace App\Helpers;

use Exception;

class MediaHelper
{
    /**
     * @param \Illuminate\Http\UploadedFile $file
     * @return string $filename
     */
    public static function storeMedia($file)
    {
        if(! $file) throw new Exception('file should not be null');

        $filename = 'video-' . uniqid() . $file->getClientOriginalExtension();

        $file->storeAs('videos', $filename);

        return $filename;
    }
}