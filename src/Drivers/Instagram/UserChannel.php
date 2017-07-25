<?php

namespace Aggregator\Drivers\Instagram;

use Aggregator\Foundation\AbstractDriverChannel;

class UserChannel extends AbstractDriverChannel
{

    /**
     * Fetch broadcasts for channel
     * @return [type] [description]
     */
    public function fetch()
    {
        // Gets feed results of the channel
        $posts = (new InstagramClient())->getChannelPosts($this->channel);

        //adapts those broadcasts and saves to channel
        return (new InstagramAdapter($posts))->saveToChannel($this->channel);

    }
}
