<?php

namespace Clash\Helper;

use Psr\Http\Message\ResponseInterface;

class JsonHelper
{
    public static function respond(ResponseInterface $response, $json, $code = 200)
    {
        return $response
            ->withJson($json)
            ->withStatus($code)
            ->withHeader("Content-Type", "application/json");
    }

    public static function respondWithError(ResponseInterface $response, $error = 'An unexpected error occured', $code = 500)
    {
        return self::respond($response, array('error' => $error), $code);
    }

    public static function respondWithNotFound(ResponseInterface $response, $error = 'Not Found', $code = 404)
    {
        return self::respond($response, array('error' => $error), $code);
    }
}
