<?php


namespace App\Application\Actions\KeyValuePair;

use Psr\Http\Message\ResponseInterface as Response;


class ListKeyValuePairsAction extends KeyValuePairAction
{

    protected function action(): Response
    {
        return $this->respondWithData(
            $this->keyValuePairRepository->findAll()
        );
    }
}
