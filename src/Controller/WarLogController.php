<?php

namespace Clash\Controller;

use Clash\Helper\JsonHelper;

class WarLogController extends CoreController
{
    public function __construct($client)
    {
        $this->client = $client;
    }

    public function index($request, $response)
    {
        $warLog = $this->client->call('clans/'.CLAN_TAG.'/warlog');
        return JsonHelper::respond($response, array(
            'warLog' => $warLog
        ));
    }
}
