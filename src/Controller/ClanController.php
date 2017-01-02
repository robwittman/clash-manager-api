<?php

namespace Clash\Controller;

use Clash\Helper\JsonHelper;
use Clash\Model\Clan;

class ClanController extends CoreController
{
    protected $client;

    protected static $permissions = array(
        'show' => 'read_clans'
    );

    public function __construct($client)
    {
        $this->client = $client;
    }

    public function show($request, $response, $arguments)
    {
        $clan = $this->client->call("clans/".CLAN_TAG);
        return JsonHelper::respond($response, array(
            'clan' => $clan
        ));
    }
}
