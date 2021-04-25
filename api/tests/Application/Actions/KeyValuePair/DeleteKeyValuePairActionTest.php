<?php


namespace Test\Application\Actions\KeyValuePair;


use App\Application\Actions\ActionPayload;
use App\Domain\KeyValuePair\KeyNotFoundException;
use App\Domain\KeyValuePair\KeyValuePairRepository;
use App\Infrastructure\Persistence\KeyValuePair\InMemoryKeyValuePairRepository;
use Tests\Application\Actions\ActionTest;

class DeleteKeyValuePairActionTest extends ActionTest
{
    public function setUp(): void
    {
        parent::setUp();

        $keyValuePairRepository = new InMemoryKeyValuePairRepository();
        $this->container->set(KeyValuePairRepository::class, $keyValuePairRepository);
    }

    public function testAction()
    {
        $request = $this->createRequest('DELETE', '/keyvalues/foo');
        $response = $this->app->handle($request);

        $this->assertEquals($response->getStatusCode(), 204);

        $this->expectException(KeyNotFoundException::class);
        $this->container->get(KeyValuePairRepository::class)->findByKey('foo');
    }
}