<?php

namespace Aggregator\Drivers\Tumblr;

use Aggregator\Foundation\AbstractDriverClient;

class TumblrClient extends AbstractDriverClient
{
    protected $token;

    public function __construct()
    {
        $this->token = config('aggregator.tumblr_api_key');
    }

    public function apiUrl($path)
    {
        return "http://api.tumblr.com/v2{$path}api_key={$this->token}";
    }

    public function request($path)
    {
        return parent::request($this->apiUrl($path));
    }

    public function hashtag($hashtag)
    {
        $response = $this->request("/tagged/?tag={$hashtag}&");
        return array_get($response, 'response', []);
    }

}
