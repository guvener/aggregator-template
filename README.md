# Aggregator Template

Simple template that can be adapted for creating aggregation jobs.

## Install

This template is not registered to packagist and it should be installed manually via composer autoload.

Clone aggregator template to your project's root folder

Update your composer.json autoload to load from Aggregator namespace.

``` json
"autoload": {
        "psr-4": {
            "App\\": "app/",
            "Aggregator\\": "aggregator-template/"
        }
    },
```

Migrate database

``` bash
composer dumpautoload
php artisan migrate:refresh
```

Routes
```
/channels/flickr/hashtag/dog
```
