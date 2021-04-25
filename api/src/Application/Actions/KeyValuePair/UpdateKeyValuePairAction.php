<?php


namespace App\Application\Actions\KeyValuePair;


use App\Application\Actions\ActionPayload;
use App\Domain\DomainException\DomainRecordNotFoundException;
use App\Domain\KeyValuePair\KeyNotFoundException;
use Assert\Assert;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Exception\HttpBadRequestException;

class UpdateKeyValuePairAction extends KeyValuePairAction
{

    protected function action(): Response
    {
        $key = $this->resolveArg('key');
        $data = (array) $this->request->getParsedBody();

        Assert::lazy()
            ->that($data['value'])
            ->notEmpty()
            ->verifyNow();

        $value = $data['value'];

        try {
            $updatedKeyValuePair = $this->keyValuePairRepository
                ->updateKey($key, $value);

            return $this->respondWithData($updatedKeyValuePair);
        }

        catch (KeyNotFoundException $exception)
        {
            return $this->respond(new ActionPayload(400, [
                'error' => "The key ${key} does not exists"
            ]));
        }
    }
}