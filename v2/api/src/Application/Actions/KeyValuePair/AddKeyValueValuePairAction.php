<?php


namespace App\Application\Actions\KeyValuePair;


use App\Application\Actions\ActionPayload;
use App\Domain\KeyValuePair\KeyNotFoundException;
use App\Domain\KeyValuePair\KeyValuePair;
use Assert\Assert;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Exception\HttpBadRequestException;

class AddKeyValueValuePairAction extends KeyValuePairAction
{
    protected function action(): Response
    {
        $data = (array) $this->request->getParsedBody();
        $key = $data['key'];

        Assert::lazy()
            ->that($data['key'])
            ->notEmpty()
            ->verifyNow();

        Assert::lazy()
            ->that($data['value'])
            ->notEmpty()
            ->verifyNow();

        $value = $data['value'];

        try {
            $this->keyValuePairRepository->findByKey($key);

            $foundKeyPayload = new ActionPayload(400, [
                'error' => "The key ${key} already exists"
            ]);

            return $this->respond($foundKeyPayload);
        }

        catch (KeyNotFoundException $exception) {
            $keyValuePair = new KeyValuePair($key, $value);
            $this->keyValuePairRepository->add($keyValuePair);

            return $this->respondWithData($keyValuePair, 201);
        }
    }
}