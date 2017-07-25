<?php

namespace Aggregator\Foundation;

use Aggregator\Models\Channel;

abstract class AbstractDriverChannel implements DriverEndpointContract
{
    protected $channel;

    /**
     * Create a new Facade instance.
     *
     * @return void
     */
    public function __construct(Channel $channel)
    {
        $this->channel = $channel;
    }

    public function client()
    {
        return DriverFactory::getDriverClient($this->channel->source);
    }

    public function adapter()
    {
        return DriverFactory::getDriverAdapter($this->channel->source);
    }

    /**
     * Fetch broadcasts for channel
     * @return [type] [description]
     */
    public function fetch()
    {
        // Gets feed results of the channel
        $posts = $this->client()->getChannelPosts($this->channel);

        //adapts those broadcasts and saves to channel
        return $this->adapter()->setPosts($posts)->saveToChannel($this->channel);
    }

}
