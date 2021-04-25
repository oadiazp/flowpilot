<?php

namespace App\Domain\KeyValuePair;

interface KeyValuePairRepository
{
    public function add(KeyValuePair $keyValuePair): void;

    public function findAll(): array;

    public function findByKey(string $key): KeyValuePair;

    public function delete(string $key): void;
}