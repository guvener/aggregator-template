<?php
namespace Aggregator\Controllers;

use Aggregator\Jobs\ChannelJob;
use Aggregator\Models\Channel;
use Aggregator\Models\SocialPost;
use Illuminate\Http\Request;

class ChannelController
{
    public function index(Request $request)
    {
        return Channel::all();
    }

    public function show($source, $type, $parameter, Request $request)
    {
        // Check if channel exists
        $channel = Channel::firstOrCreate(compact('source', 'type', 'parameter'));
        dispatch(new ChannelJob($channel));

        return $channel->posts->take(50);
    }

    public function search($type, $parameter, Request $request)
    {
        // Check if channel exists
        $channelIds = Channel::whereType($type)->whereParameter($parameter)->select('id')->get()->pluck('id')->values();

        //
        $socialPosts = SocialPost::with(['channels' => function ($query) use ($channelIds) {
            $query->whereIn('channel_id', $channelIds);
        }])->get();

        return $socialPosts->take(50);
    }
}
