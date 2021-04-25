<?php


namespace App\Application\Actions\KeyValuePair;


use App\Application\Actions\ActionPayload;
use App\Domain\DomainException\DomainRecordNotFoundException;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Exception\HttpBadRequestException;

class DeleteKeyValuePairAction extends KeyValuePairAction
{

    protected function action(): Response
    {
        $key = $this->resolveArg('key');
        $this->keyValuePairRepository->delete($key);

        return $this->respond(new ActionPayload(204));
    }
}