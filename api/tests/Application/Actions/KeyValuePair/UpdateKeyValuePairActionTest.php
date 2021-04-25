<?php


namespace Test\Application\Actions\KeyValuePair;


use App\Application\Actions\ActionPayload;
use App\Domain\KeyValuePair\KeyValuePairRepository;
use App\Infrastructure\Persistence\KeyValuePair\InMemoryKeyValuePairRepository;
use Tests\Application\Actions\ActionTest;

class UpdateKeyValuePairActionTest extends ActionTest
{
    protected function setUp() : void
    {
        parent::setUp();

        $keyValuePairRepository = new InMemoryKeyValuePairRepository();
        $this->container->set(KeyValuePairRepository::class, $keyValuePairRepository);
    }

    public function testAction()
    {
        $request = $this->createRequest('PUT', '/keyvalues/foo');
        $request = $request->withParsedBody([
            'value' => 'bar1'
        ]);
        $response = $this->app->handle($request);

        $payload = (string) $response->getBody();
        $expectedPayload = new ActionPayload(200, [
            'key' => 'foo',
            'value' => 'bar1'
        ]);
        $serializedPayload = json_encode($expectedPayload, JSON_THROW_ON_ERROR | JSON_PRETTY_PRINT);

        $this->assertEquals($serializedPayload, $payload);
    }

    public function testUpdateMissingKeyAction()
    {
        $request = $this->createRequest('PUT', '/keyvalues/missing');
        $request = $request->withParsedBody([
            'value' => 'bar1'
        ]);
        $response = $this->app->handle($request);

        $payload = (string) $response->getBody();
        $expectedPayload = new ActionPayload(400, [
            'error' => 'The key missing does not exists'
        ]);
        $serializedPayload = json_encode($expectedPayload, JSON_THROW_ON_ERROR | JSON_PRETTY_PRINT);

        $this->assertEquals($serializedPayload, $payload);
    }
}