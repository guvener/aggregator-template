<?php

namespace Aggregator\Drivers\Flickr;

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
        $posts = (new FlickrClient())->getChannelPosts($this->channel);

        //adapts those broadcasts and saves to channel
        return (new FlickrAdapter($posts))->saveToChannel($this->channel);
    }
}
