<?php

namespace Aggregator\Drivers\Tumblr;

use Aggregator\Foundation\AbstractDriverChannel;

class HashtagChannel extends AbstractDriverChannel
{

    /**
     * Fetch broadcasts for channel
     * @return [type] [description]
     */
    public function fetch()
    {
        // Gets feed results of the channel
        $posts = (new TumblrClient())->getChannelPosts($this->channel);

        //adapts those broadcasts and saves to channel
        return (new TumblrAdapter($posts))->saveToChannel($this->channel);
    }
}
