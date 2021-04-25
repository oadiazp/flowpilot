<?php

namespace App\Infrastructure\Persistence\KeyValuePair;


use App\Domain\KeyValuePair\KeyNotFoundException;
use App\Domain\KeyValuePair\KeyValuePair;
use App\Domain\KeyValuePair\KeyValuePairRepository;
use App\Infrastructure\Persistence\AbstractDatabaseRepository;
use Doctrine\ORM\EntityManager;
use function Webmozart\Assert\Tests\StaticAnalysis\null;

class DatabaseKeyValuePairRepository extends AbstractDatabaseRepository implements KeyValuePairRepository
{
    public function __construct(EntityManager $entityManager)
    {
        $this->repository = $entityManager->getRepository(KeyValuePair::class);
        $this->entity_manager = $entityManager;
    }

    public function add(KeyValuePair $keyValuePair): void
    {
        $this->entity_manager->persist($keyValuePair);
        $this->entity_manager->flush();
    }

    public function findAll(): array
    {
        return $this->repository->findAll();
    }

    public function findByKey(string $key): KeyValuePair
    {
        $keyValuePair = $this->repository->find($key);

        if (null === $keyValuePair) {
            throw new KeyNotFoundException();
        }

        return $keyValuePair;
    }

    public function delete(string $key): void
    {
        $keyValuePair = $this->findByKey($key);
        $this->entity_manager->remove($keyValuePair);
        $this->entity_manager->flush();
    }

    public function validateThatTheKeyExists(string $key): bool
    {
        $keyValuePair = $this->findByKey($key);

        if (null === $keyValuePair) {
            throw new KeyNotFoundException();
        }

        return true;
    }

    public function updateKey(string $key, string $value): KeyValuePair
    {
        $keyValuePair = $this->findByKey($key);
        $keyValuePair->setValue($value);
        $this->entity_manager->persist($keyValuePair);
        $this->entity_manager->flush();

        return $keyValuePair;
    }
}