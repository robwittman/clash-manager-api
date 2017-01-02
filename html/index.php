<?php

$env = getenv("SLIM_ENV") ? getenv("SLIM_ENV") : "production";
define("SLIM_ENV", $env);
define("CLAN_TAG", '#8JUUCVCL');

require_once '../vendor/autoload.php';
require_once '../src/settings.php';

$app = new Slim\App($settings);

require_once '../src/container.php';

require_once '../src/Route/auth.routes.php';
require_once '../src/Route/clan.routes.php';
require_once '../src/Route/member.routes.php';
require_once '../src/Route/user.routes.php';

use Clash\Helper\JsonHelper;

$app->add(new \Slim\Middleware\JwtAuthentication(array(
    'secret' => getenv("JWT_SECRET"),
    'secure' => false,
    'path' => array(
        "/clan",
        "/members",
        "/users"
    ),
    'passthrough' => array(
        '/auth/token'
    ),
    'algorithm' => array('HS256'),
    'error' => function ($request, $response, $arguments) {
        return JsonHelper::respondWithError($response, "Invalid authentication", 401);
    },
    'attribute' => "jwt"
)));

$app->run();
