<?php

namespace Aggregator\Drivers\Flickr;

use Aggregator\Foundation\AbstractDriverClient;

class FlickrClient extends AbstractDriverClient
{
    protected $token;

    public function __construct()
    {
        $this->token = config('aggregator.flickr_api_key');
    }

    public function apiUrl($path)
    {
        return "https://api.flickr.com/services/rest/{$path}api_key={$this->token}&extras=owner_name,description,tags,date_upload,path_alias,url_l,url_o,geo&format=json&nojsoncallback=1";
    }

    public function request($path)
    {
        $response = parent::request($this->apiUrl($path));
        return array_get($response, 'photos.photo', []);
    }

    public function hashtag($hashtag)
    {
        $encodedHashtag = urlencode("#{$hashtag}");
        return $this->request("?method=flickr.photos.search&tags={$encodedHashtag}&");
    }

    public static function userLink($screenName)
    {
        return "https://www.flickr.com/photos/{$screenName}";
    }

}
