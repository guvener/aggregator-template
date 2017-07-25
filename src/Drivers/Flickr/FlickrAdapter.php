<?php

namespace Aggregator\Drivers\Flickr;

use Aggregator\Foundation\AbstractDriverAdapter;
use Carbon\Carbon;

class FlickrAdapter extends AbstractDriverAdapter
{
    protected $source = 'flickr';

    public function getSourceId($item)
    {
        return $item['id'];
    }

    protected function adapt($item)
    {

        $title = $item['title'];
        $descriptionRaw = array_get($item, 'description._content', ''); // @todo this has raw content.
        $description = trim(htmlspecialchars_decode(strip_tags($descriptionRaw)));
        $link = FlickrClient::userLink($item['pathalias'], $item['id']);

        $sizePrefix = array_has($item, 'url_l') ? '_l' : null;
        if (!isset($sizePrefix)) {
            $sizePrefix = array_has($item, 'url_o') ? '_o' : null;
        }

        if (isset($sizePrefix)) {
            $media = $item["url{$sizePrefix}"];
        }

        $sid = $item['id'];
        $source = $this->source;
        $createdAt = Carbon::createFromTimestamp($item['dateupload']);
        $posted_at = $createdAt->toDateTimeString();

        return $this->newPost(compact('sid', 'source', 'title', 'link', 'description', 'media', 'posted_at'));
    }
}
