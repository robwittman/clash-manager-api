<?php

require_once '../vendor/autoload.php';

$container = $app->getContainer();

$capsule = new \Illuminate\Database\Capsule\Manager;
$capsule->addConnection($settings['db']);
$capsule->setAsGlobal();
$capsule->bootEloquent();

$capsule->getContainer()->singleton(
    \Illuminate\Contracts\Debug\ExceptionHandler::class,
    \Clash\Exception\CustomException::class
);

$container['db'] = function ($c) use ($capsule) {
    return $capsule;
};

$container['db'] = function ($c) {
    return null;
};

$container['redis'] = function ($c) {
    return null;
};

$container['foundHandler'] = function ($c) {
    return new \Clash\Handler\ClashRouteHandler();
};

$container['AuthController'] = function ($c) {
    return new \Clash\Controller\AuthController();
};

$container['ClanController'] = function ($c) {
    return new \Clash\Controller\ClanController($c->get('ClashApiClient'));
};

$container['MemberController'] = function ($c) {
    return new \Clash\Controller\MemberController($c->get('ClashApiClient'));
};

$container['WarLogController'] = function ($c) {
    return new \Clash\Controller\WarLogController($c->get('ClashApiClient'));
};

$container['UserController'] = function ($c) {
    return new \Clash\Controller\UserController();
};

$container['ClashApiClient'] = function ($c) {
    return new Clash\Helper\ApiClient(array(
        'api_key' => getenv("CLASH_API_KEY"),
        'clan_tag' => CLAN_TAG
    ));
};
