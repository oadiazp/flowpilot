<?php


namespace Test\Application\Actions\KeyValuePair;

use App\Application\Actions\ActionPayload;
use App\Domain\KeyValuePair\KeyValuePairRepository;
use App\Infrastructure\Persistence\KeyValuePair\InMemoryKeyValuePairRepository;
use Tests\Application\Actions\ActionTest;


class AddKeyValuePairActionTest extends ActionTest
{
    protected function setUp() : void
    {
        parent::setUp();

        $keyValuePairRepository = new InMemoryKeyValuePairRepository();
        $this->container->set(KeyValuePairRepository::class, $keyValuePairRepository);
    }

    public function testAction(): void
    {
        $response = $this->makeRequest([
            'key' => 'bill.gates',
            'value' => 'Microsoft',
        ]);

        $keyValuePairRepository = $this->container->get(KeyValuePairRepository::class);
        $all = $keyValuePairRepository->findAll();
        $keyValuePair = end($all);

        $payload = (string)$response->getBody();
        $expectedPayload = new ActionPayload(201, $keyValuePair);
        $serializedPayload = json_encode($expectedPayload, JSON_THROW_ON_ERROR | JSON_PRETTY_PRINT);

        $this->assertEquals($serializedPayload, $payload);
    }

    public function testAlreadyExistingKey()
    {
        $response = $this->makeRequest([
            'key' => 'foo',
            'value' => 'bar',
        ]);

        $payload = (string)$response->getBody();
        $expectedPayload = new ActionPayload(400, [
            'error' => 'The key foo already exists'
        ]);
        $serializedPayload = json_encode($expectedPayload, JSON_THROW_ON_ERROR | JSON_PRETTY_PRINT);

        $this->assertEquals($serializedPayload, $payload);
    }

    public function makeRequest($postParams)
    {
        $request = $this->createRequest('POST', '/keyvalues');
        $request = $request->withParsedBody($postParams);
        $response = $this->app->handle($request);

        return $response;
    }
}