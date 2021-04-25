<?php

namespace App\Domain\KeyValuePair;

use JsonSerializable;

class KeyValuePair implements JsonSerializable
{
    private string $key;
    private string $value;

    public function __construct(string $key, string $value)
    {
        $this->key = $key;
        $this->value = $value;
    }

    public function getKey(): string
    {
        return $this->key;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function jsonSerialize()
    {
        return [
            'key' => $this->getKey(),
            'value' => $this->getValue(),
        ];
    }

    public function setValue(string $value)
    {
        $this->value = $value;
    }
}