<?php


namespace App\Application\Actions\KeyValuePair;


use App\Application\Actions\Action;
use App\Domain\DomainException\DomainRecordNotFoundException;
use App\Domain\KeyValuePair\KeyValuePairRepository;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;
use Slim\Exception\HttpBadRequestException;

abstract class KeyValuePairAction extends Action
{
    protected KeyValuePairRepository $keyValuePairRepository;

    public function __construct(LoggerInterface $logger, KeyValuePairRepository $keyValuePairRepository)
    {
        parent::__construct($logger);
        $this->keyValuePairRepository = $keyValuePairRepository;
    }
}
