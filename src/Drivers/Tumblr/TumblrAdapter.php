<?php

namespace Aggregator\Drivers\Tumblr;

use Aggregator\Foundation\AbstractDriverAdapter;
use Carbon\Carbon;

class TumblrAdapter extends AbstractDriverAdapter
{
    protected $source = 'tumblr';

    public function getSourceId($item)
    {
        return $item['id'];
    }

    protected function adapt($item)
    {

        $title = $item['summary'];
        $descriptionRaw = array_get($item, 'reblog.comment', '');
        $description = trim(htmlspecialchars_decode(strip_tags($descriptionRaw)));
        $link = $item['post_url'];

        $photos = array_get($item, 'photos', []);
        $photos = count($photos) > 0 ? $photos[0] : []; // first element is interesting
        $original = array_get($photos, 'original_size', null); // url, width, height
        $media = array_get($original, 'url', null);

        $sid = $item['id'];
        $source = $this->source;
        $createdAt = Carbon::createFromTimestamp($item['timestamp']);
        $posted_at = $createdAt->toDateTimeString();

        return $this->newPost(compact('sid', 'source', 'title', 'link', 'description', 'media', 'posted_at'));
    }
}
