<?php


namespace App\Application\Actions\KeyValuePair;


use App\Application\Actions\ActionPayload;
use App\Domain\DomainException\DomainRecordNotFoundException;
use App\Domain\KeyValuePair\KeyNotFoundException;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Exception\HttpBadRequestException;

class ViewKeyValuePairAction extends KeyValuePairAction
{
    protected function action(): Response
    {
        $key = $this->resolveArg('key');

        try {
            $keyValuePair = $this->keyValuePairRepository->findByKey($key);

            return $this->respondWithData($keyValuePair);
        }
        catch (KeyNotFoundException $exception) {
            $notFoundResponse = new ActionPayload(400, [
                'error' => "The key ${key} does not exists"
            ]);

            return $this->respond($notFoundResponse);
        }
    }

}