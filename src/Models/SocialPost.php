<?php

namespace Aggregator\Models;

class SocialPost extends BaseModel
{
    protected $fillable = ['sid', 'source', 'title', 'description', 'media', 'posted_at', 'created_at', 'updated_at'];

    protected $hidden = ['pivot', 'channels'];

    /**
     * Get the broadcasts for this channel
     */
    public function channels()
    {
        return $this->belongsToMany(Channel::class);
    }
}
