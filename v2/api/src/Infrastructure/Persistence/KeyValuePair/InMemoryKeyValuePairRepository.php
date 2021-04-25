<?php


namespace App\Infrastructure\Persistence\KeyValuePair;


use App\Domain\KeyValuePair\KeyValuePair;
use App\Domain\KeyValuePair\KeyValuePairRepository;
use App\Domain\KeyValuePair\KeyNotFoundException;
use function Webmozart\Assert\Tests\StaticAnalysis\null;

class InMemoryKeyValuePairRepository implements KeyValuePairRepository
{
    private array $keyValuePairs = [];

    /**
     * InMemoryKeyValuePairRepository constructor.
     * @param array $keyValuePairs
     */
    public function __construct(array $keyValuePairs = null)
    {
        if (null === $keyValuePairs) {
            $keyValuePairs = [
                new KeyValuePair('alice', 'bob'),
                new KeyValuePair('foo', 'bar'),
            ];
        }

        foreach ($keyValuePairs as $keyValuePair) {
            $this->keyValuePairs[$keyValuePair->getKey()] = $keyValuePair;
        }
    }


    public function add(KeyValuePair $keyValuePair): void
    {
        $this->keyValuePairs[$keyValuePair->getKey()] = $keyValuePair;
    }

    public function findAll(): array
    {
        return array_values($this->keyValuePairs);
    }

    public function findByKey(string $key): KeyValuePair
    {
        $this->validateThatTheKeyExists($key);

        return $this->keyValuePairs[$key];
    }

    public function delete(string $key): void
    {
        $this->validateThatTheKeyExists($key);

        unset($this->keyValuePairs[$key]);
    }

    public function validateThatTheKeyExists(string $key): bool
    {
        if (!isset($this->keyValuePairs[$key])) {
            throw new KeyNotFoundException();
        }

        return true;
    }

    public function updateKey(string $key, string $value): KeyValuePair
    {
        $this->validateThatTheKeyExists($key);

        $this->keyValuePairs[$key] = new KeyValuePair($key, $value);

        return $this->keyValuePairs[$key];
    }
}