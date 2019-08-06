# Events Sender
Applications events sender

## Install

    composer require arquivei/events-sender
    
## Usage

Create your exporter and pass for Sender class

You can use the entities schemas:
```php
<?php

$exporter = new \Arquivei\Events\Sender\Exporters\File('filePath');

$sender = new \Arquivei\Events\Sender\Sender($exporter);

/**
 * @param \Arquivei\Events\Sender\Schemas\ClassicSchema $schema
 * @param string $stream
 */
$sender->push($schema, $stream);
```

```php
<?php

$exporter = new \Arquivei\Events\Sender\Exporters\File('filePath');

$sender = new \Arquivei\Events\Sender\Sender($exporter);

/**
 * @param \Arquivei\Events\Sender\Schemas\LatestSchema $schema
 * @param string $stream
 */
$sender->push($schema, $stream);
```
Or use the factories:
```php
<?php

$exporter = new \Arquivei\Events\Sender\Exporters\File('filePath');

$sender = new \Arquivei\Events\Sender\Sender($exporter);

/**
 * @param \Arquivei\Events\Sender\Factories\LatestSchemaFactory $schema
 * @param string $stream
 */
$sender->push($schema, $stream);
```

```php
<?php

$exporter = new \Arquivei\Events\Sender\Exporters\File('filePath');

$sender = new \Arquivei\Events\Sender\Sender($exporter);

/**
 * @param \Arquivei\Events\Sender\Factories\ClassicSchemaFactory $schema
 * @param string $stream
 */
$sender->push($schema, $stream);
```

## Important

- Pass your exporters in order to, if the first one fails, the second be called.
- To call only one exporter configure only one of them.

## Run Tests

`$ vendor/phpunit/phpunit/phpunit tests`
