<?php

namespace Aggregator\Drivers\Instagram;

use Aggregator\Foundation\AbstractDriverAdapter;
use Carbon\Carbon;

class InstagramAdapter extends AbstractDriverAdapter
{
    protected $source = 'instagram';

    public function getSourceId($item)
    {
        return $item['id'];
    }

    protected function adapt($item)
    {

        $images = array_get($item, 'images', null);
        $link = $item['link'];
        $caption = array_get($item, 'caption', null);
        $descriptionRaw = $caption['text'];
        $description = trim(htmlspecialchars_decode(strip_tags($descriptionRaw)));

        if (count($images) > 0) {
            $mediaEntity = $images['standard_resolution'];
            $media = $mediaEntity['url'];
        }

        $sid = $item['id'];
        $source = $this->source;
        $createdAt = Carbon::createFromTimestamp($item['created_time']);
        $posted_at = $createdAt->toDateTimeString();

        return $this->newPost(compact('sid', 'source', 'title', 'link', 'description', 'media', 'posted_at'));
    }
}
