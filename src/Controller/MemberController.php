<?php

namespace Clash\Controller;

use Clash\Helper\JsonHelper;

class MemberController extends CoreController
{
    public function __construct($client)
    {
        $this->client = $client;
    }

    public function index($request, $response)
    {
        $members = $this->client->call('clans/'.CLAN_TAG.'/members');
        return JsonHelper::respond($response, array('members' => $members->items));
    }

    public function show($request, $response, $arguments)
    {
        $playerTag = $arguments['playerTag'];
        $member = $this->client->call('players/'.$playerTag);
        return JsonHelper::respond($response, array('member' => $member));
    }
}
