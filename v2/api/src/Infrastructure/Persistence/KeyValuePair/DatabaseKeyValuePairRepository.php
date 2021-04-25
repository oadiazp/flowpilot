<?php

namespace App\Infrastructure\Persistence\KeyValuePair;


use App\Domain\KeyValuePair\KeyValuePair;
use App\Domain\KeyValuePair\KeyValuePairRepository;
use App\Infrastructure\Persistence\KeyValuePair\AbstractDatabaseRepository;
use Doctrine\ORM\EntityManager;
use KeyNotFoundException;
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
        // TODO: Implement delete() method.
    }
}