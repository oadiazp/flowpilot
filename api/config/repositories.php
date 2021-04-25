<?php declare(strict_types=1);

use App\Domain\KeyValuePair\KeyValuePairRepository;
use App\Infrastructure\Persistence\KeyValuePair\DatabaseKeyValuePairRepository;


use function DI\autowire;

return [
    KeyValuePairRepository::class => autowire(DatabaseKeyValuePairRepository::class),
];
