<?php 

namespace App\Actions\Media;

use App\Actions\Handler;
use App\Helpers\MediaHelper;
use App\Models\Media;

class StoreMedia implements Handler
{
    public function handel($command) 
    {
        $filepath = MediaHelper::storeMedia($command->media);

        Media::create([
            'path' => $filepath,
            'mediable_type' => $command->mediable_type,
            'mediable_id' => $command->mediable_id,
            'is_default' => $command->is_default
        ]);
    }
}