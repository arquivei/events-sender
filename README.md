# Events Sender
Applications events sender

## Install

    composer require arquivei/events-sender
    
## Usage

Create you exporter and pass for Sender class

```php
<?php

$exporter = new \Arquivei\Events\Sender\Exporters\File('filePath');

$sender = new \Arquivei\Events\Sender\Sender($exporter);

/**
 * @param \Arquivei\Events\Sender\Message $message
 * @param string $stream
 */
$sender->push($message, $stream);
```

## Important

- Pass your exporters in order to, if the first one fails, the second be called.
- To call only one exporter configure only one of them.

## Run Tests

`$ vendor/phpunit/phpunit/phpunit tests`
