<?php


namespace Test\Application\Actions\KeyValuePair;


use App\Application\Actions\ActionPayload;
use App\Domain\KeyValuePair\KeyValuePairRepository;
use App\Infrastructure\Persistence\KeyValuePair\InMemoryKeyValuePairRepository;
use Tests\Application\Actions\ActionTest;

class ListKeyValuePairsActionTest extends ActionTest
{
    protected function setUp() : void
    {
        parent::setUp();

        $keyValuePairRepository = new InMemoryKeyValuePairRepository();
        $this->container->set(KeyValuePairRepository::class, $keyValuePairRepository);
    }

    public function testAction()
    {
        $request = $this->createRequest('GET', '/keyvalues');
        $response = $this->app->handle($request);

        $payload = (string) $response->getBody();
        $expectedPayload = new ActionPayload(200, [
            [
                'key' => 'alice',
                'value' => 'bob'
            ],
            [
                'key' => 'foo',
                'value' => 'bar'
            ],
        ]);
        $serializedPayload = json_encode($expectedPayload, JSON_THROW_ON_ERROR | JSON_PRETTY_PRINT);

        $this->assertEquals($serializedPayload, $payload);
    }
}