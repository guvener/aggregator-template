<?php

namespace Aggregator\Drivers\Instagram;

use Aggregator\Foundation\AbstractDriverClient;

class InstagramClient extends AbstractDriverClient
{
    public function user($user)
    {
        $response = $this->request("https://www.instagram.com/{$user}/media/");
        return array_get($response, 'items', []);
    }
}
