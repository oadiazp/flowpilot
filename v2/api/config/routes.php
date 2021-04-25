<?php declare(strict_types=1);

use App\Application\Actions\KeyValuePair\AddKeyValueValuePairAction;
use App\Application\Actions\KeyValuePair\DeleteKeyValuePairAction;
use App\Application\Actions\KeyValuePair\ListKeyValuePairsAction;
use App\Application\Actions\KeyValuePair\UpdateKeyValuePairAction;
use App\Application\Actions\KeyValuePair\ViewKeyValuePairAction;

use App\Application\Actions\User\AddUserAction;
use App\Application\Actions\User\ListUsersAction;
use App\Application\Actions\User\ViewUserAction;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return static function (App $app) {
    $app->options('/{routes:.*}', function (Request $request, Response $response) {
        // CORS Pre-Flight OPTIONS Request Handler
        return $response;
    });

    $app->get('/', function (Request $request, Response $response) {
        $response->getBody()->write('Hello world!');
        return $response;
    });

    $app->group('/users', function (Group $group) {
        $group->get('', ListUsersAction::class);
        $group->get('/{id}', ViewUserAction::class);
        $group->post('', AddUserAction::class);
    });

    $app->group('/keyvalues', function (Group $group) {
        $group->get('', ListKeyValuePairsAction::class);
        $group->get('/{key}', ViewKeyValuePairAction::class);
        $group->post('', AddKeyValueValuePairAction::class);
        $group->delete('/{key}', DeleteKeyValuePairAction::class);
        $group->put('/{key}', UpdateKeyValuePairAction::class);
    });
};
