<?php

namespace Aggregator\Foundation;

use Aggregator\Models\Channel;

abstract class AbstractDriverAdapter
{
    protected $posts;
    protected $channel;
    protected $source;

    /**
     * Get Rss Feed posts
     * @param Array
     */
    public function __construct($posts = null)
    {
        $this->setPosts($posts);
    }

    public function setPosts($posts)
    {
        $this->posts = $posts;
        return $this;
    }

    abstract public function getSourceId($post);

    abstract protected function adapt($post);

    /**
     * Adapt all posts and save to given channel
     * @param  Channel $channel
     * @return Collection SocialPosts
     */
    public function saveToChannel(Channel $channel)
    {
        $adaptedPosts = collect($this->posts)->map(function ($item) {
            return $this->adapt($item);
        });
        return (new SocialPostRepository($adaptedPosts, $channel))->save();
    }

    protected function newPost($item)
    {
        $broadcast = SocialPostRepository::find($item['sid'], $this->source);

        if (empty($broadcast)) {
            $broadcast = SocialPostRepository::newSocialPost($item);
        }

        return $broadcast;
    }
}
