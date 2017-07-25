<?php

namespace Aggregator\Foundation;

class DriverFactory
{

    /**
     * Create new Driver instance and return
     * @param  Channel $channel
     * @return new Driver instance
     */
    public static function getDriverChannel($channel)
    {
        $source = ucfirst($channel->source);
        $methodType = ucfirst(camel_case($channel->type));
        $driverFacade = "Aggregator\Drivers\\{$source}\\{$methodType}Channel";
        return class_exists($driverFacade) ? (new $driverFacade($channel)) : null;
    }

    /**
     * Create new Data Adapter instance and return
     * @param  Channel $channel
     * @return new Adapter instance
     */
    public static function getDriverAdapter($source)
    {
        $source = ucfirst($source);
        $adapter = "Aggregator\Drivers\\{$source}\\{$source}Adapter";
        return class_exists($adapter) ? (new $adapter()) : null;
    }

    /**
     * Create new Driver Client instance and return
     * @param  Channel $channel
     * @return new Client instance
     */
    public static function getDriverClient($source)
    {
        $source = ucfirst($source);
        $client = "Aggregator\Drivers\\{$source}\\{$source}Client";
        return class_exists($client) ? (new $client()) : null;
    }
}
