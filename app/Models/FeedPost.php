<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FeedPost extends Model
{
    protected $fillable = [
        'feed_source_id',
        'external_id',
        'title',
        'url',
        'author',
        'image_url',
        'content',
        'posted_at',
    ];

    protected $casts = [
        'posted_at' => 'datetime',
    ];

    public function source(): BelongsTo
    {
        return $this->belongsTo(FeedSource::class, 'feed_source_id');
    }
}
