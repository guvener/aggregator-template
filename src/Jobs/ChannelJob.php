<?php

namespace Aggregator\Jobs;

use Aggregator\Foundation\DriverFactory;
use Aggregator\Models\Channel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ChannelJob implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 3;

    protected $channel;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Channel $channel)
    {
        $this->channel = $channel;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        DriverFactory::getDriverChannel($this->channel)->fetch();
    }
}
