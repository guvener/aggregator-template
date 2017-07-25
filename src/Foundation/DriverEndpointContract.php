<?php

namespace Aggregator\Foundation;

interface DriverEndpointContract
{

    /**
     * Fetch Endpoint SocialPosts For that Channel
     * @return boolean
     */
    public function fetch();

}
