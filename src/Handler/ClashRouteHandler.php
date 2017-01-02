<?php

namespace Clash\Handler;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Interfaces\InvocationStrategyInterface;
use Clash\Model\User;

class ClashRouteHandler implements InvocationStrategyInterface
{
    public function __invoke(
        callable $callable,
        ServerRequestInterface $request,
        ResponseInterface $response,
        array $routeArguments
    ) {
        foreach ($routeArguments as $k => $v) {
            $request = $request->withAttribute($k, $v);
        }

        $perms = $callable[0]::getRoutePermissions($callable[1]);

        if (!empty($perms)) {
            $jwt = $request->getAttribute('jwt');
            $user = User::find($jwt->uid);
            if (empty($user) || !$user->hasPermissions($perms)) {
                return $response->withStatus(401)->withJson(array(
                    'error' => "You do not have permission to access this resource"
                ));
            }
        }

        return call_user_func($callable, $request, $response, $routeArguments);
    }
}
