<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


#[Fillable(['band_id', 'name', 'photo', 'release_date', 'preview_url'])]

class Album extends Model
{
    protected $casts = [
        'release_date' => 'date',
    ];

    public function band(): BelongsTo
    {
        return $this->belongsTo(Band::class);
    }

    public function embedUrl(): ?string
    {
        if (!$this->preview_url) {
            return null;
        }

        // YouTube single video
        if (preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $this->preview_url, $matches)) {
            return 'https://www.youtube.com/embed/' . $matches[1];
        }

        // YouTube playlist / full album
        if (preg_match('/youtube\.com\/playlist\?list=([a-zA-Z0-9_-]+)/', $this->preview_url, $matches)) {
            return 'https://www.youtube.com/embed/videoseries?list=' . $matches[1];
        }

        // Spotify album, track or playlist
        if (preg_match('/open\.spotify\.com\/(album|track|playlist)\/([a-zA-Z0-9]+)/', $this->preview_url, $matches)) {
            return 'https://open.spotify.com/embed/' . $matches[1] . '/' . $matches[2];
        }

        return null;
    }
}
