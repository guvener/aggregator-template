<?php

namespace Aggregator\Models;

/**
 * Channel (Aggregation Channel) represents the data structure for calling API of any social feed and getting broadcasts for those.
 */
class Channel extends BaseModel
{

    protected $fillable = ['source', 'type', 'parameter', 'title', 'created_at', 'updated_at'];

    /**
     * Get the broadcasts for this channel
     */
    public function posts()
    {
        return $this->belongsToMany(SocialPost::class)->orderBy('posted_at', 'desc');
    }
}
