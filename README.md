# Events Sender
Applications events sender

## Install

    composer require arquivei/events-sender
    
## Usage

Create you config and pass for Sender class

```php
<?php

$config = [
    'kafka' => [
        'config' => [
            'group_id' => 'sring',
            'kafka_brokers' => 'string',
            'security_protocol' => 'string',
            'sasl_mechanisms' => 'string',
            'sasl_username' => 'string',
            'sasl_password' => 'string',
        ],
    ],
    'file' => [
        'config' => [
            'file_path' => 'string',
        ],
    ],
    'kinesis' => [
        'config' => [
            'credentials' => [
                'key' => 'string',
                'secret' => 'string',
            ],
            'region' => 'string',
            'version' => 'string',
        ],
    ],
];

$sender = new \Arquivei\Events\Sender\Sender($config);

/**
 * @param \Arquivei\Events\Sender\Message $message
 * @param string $stream
 */
$sender->push($message, $stream);
```

## Important

- Configure your exporters in order to, if the first one fails, the second be called.
- To call only one exporter configure only one of them.

## Run Tests

`$ vendor/phpunit/phpunit/phpunit tests`
