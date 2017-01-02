<?php

namespace Clash\Helper;

use GuzzleHttp\Client;

class ApiClient
{
    protected $client;

    public function __construct($config)
    {
        $this->api_key = $config['api_key'];
        $this->clan_tag = $config['clan_tag'];
        $this->setClient(new Client(array(
            'headers' => array(
                'Authorization' => 'Bearer '.$this->api_key,
                'Accept' => 'application/json'
            ),
            'base_uri' => 'https://api.clashofclans.com/v1/'
        )));
    }

    public function call($url, $params = array())
    {
        $url = str_replace('#', '%23', $url);
        $response = $this->client->get($url, array(
            'params' => $params
        ));

        return json_decode($response->getBody());
    }

    public function setClient(Client $client)
    {
        $this->client = $client;
    }
}
