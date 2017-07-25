<?php

namespace Aggregator\Foundation;

use Aggregator\Models\Channel;
use Aggregator\Models\SocialPost;

class SocialPostRepository
{
    protected $posts;
    protected $channel;

    public function __construct($posts, $channel)
    {
        $this->posts = $posts;
        $this->channel = $channel;
    }

    public static function find($sid, $source)
    {
        return SocialPost::where('sid', $sid)->where('source', $source)->first();
    }

    public static function newSocialPost($fields)
    {
        return new SocialPost($fields);
    }

    public function save()
    {
        // check if already added
        $channelPosts = $this->channel->posts->pluck('id');

        $newPosts = $this->posts->reject(function ($item) use ($channelPosts) {
            return $channelPosts->contains($item->id);
        });

        $this->channel->posts()->saveMany($newPosts);

        if (config('aggregator.pusher_enabled')) {
            $this->notifyPusher();
        }
    }

    protected function notifyPusher()
    {

        $options = [
            'cluster' => 'eu',
            'encrypted' => true,
        ];

        $pusher = new \Pusher(
            config('aggregator.pusher.api_key'),
            config('aggregator.pusher.secret'),
            config('aggregator.pusher.app_id'),
            $options
        );

        $data['channel_id'] = $this->channel->id;
        $data['message'] = 'Channel got updated';

        $pusher->trigger('my-channel', 'channel-event', $data);
    }
}
