<?php

namespace App\Observers;

use App\Models\Client;
use Illuminate\Support\Facades\Storage;

class ClientObserver
{
    public function created(Client $client): void
    {
        if ($client->image) {
            $uuid = str()->uuid();
            $extension = $client->image->extension();
            $filename = "{$uuid}.{$extension}";
            Storage::disk('public')->putFileAs('client_images', $client->image, $filename);
            $client->image = $filename;
            $client->save();
        }
    }
}
