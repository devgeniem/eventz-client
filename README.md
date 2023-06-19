# Eventz API Client

HTTP Call wrapper for Eventz API.

## Installing

```
composer require devgeniem/eventz-client
```

## Usage

```php
<?php

$client = new \Geniem\Eventz\EventzClient( 'https://backend.ver5.eventz.today/', 'api-key' );

// Get all events.
$events = $client->search_events();

// Search events with a query string.
$params        = [
    'q' => 'Example',
];
$search_events = $client->search_events( $params );

// Search organizers.
$organizers = $client->search_organizers();

// Get single item.
$item = $client->get_item( '646ee4da872c77524e22722f' );

// Get last response in full.
$response = $client->get_last_response();

// Get last response property ('headers' as an example).
$response = $client->get_last_response( 'headers' );
```

## Changelog
Please see CHANGELOG for more information about what has changed recently.

## Contributing
Contributions are highly welcome! Just leave a pull request of your awesome well-written must-have feature.

## License
This project is licensed under the GPL-3.0 License.
