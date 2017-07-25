<?php

namespace Aggregator\Foundation;

abstract class AbstractDriverClient
{

    public function request($url)
    {

        if (class_exists(\GuzzleHttp\Client::class)) {
            $client = new \GuzzleHttp\Client();
            $response = (string) $client->request('GET', $url)->getBody();
        } else {
            $response = file_get_contents($url);
        }

        return @json_decode($response, true);
    }

    public function getChannelPosts($channel)
    {
        if (!method_exists($this, $channel->type)) {
            throw new Exception("Error Invalid Function", 1);
        }

        return call_user_func([$this, $channel->type], $channel->parameter);
    }

    // if (app()->environment('test')) {
    //     return $this->requestTestData();
    // }
    // private function requestTestData()
    // {
    //     $response = file_get_contents(__DIR__ . '/../../tests/integration/flickr-hashtag.json');
    //     return @json_decode($response, true);
    // }
}
