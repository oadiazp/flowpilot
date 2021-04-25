<?php


namespace App\Infrastructure\Persistence;


use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;

class AbstractDatabaseRepository
{
    protected EntityRepository $repository;
    protected EntityManager $entity_manager;
}