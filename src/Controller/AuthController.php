<?php

namespace Clash\Controller;

use Clash\Model\User;
use Clash\Helper\JsonHelper;
use Firebase\JWT\JWT;

class AuthController extends CoreController
{
    public function authorize($request, $response)
    {
        $params = $request->getParsedBody();
        $user = User::where('username', $params['username'])->first();

        if (empty($user)) {
            return JsonHelper::respondWithError($response, "Couldn't find a user with that username", 401);
        }

        if (!$user->authenticate($params['password'])) {
            return JsonHelper::respondWithError($response, "Invalid password", 401);
        }

        $token = JWT::encode(array(
            'uid' => $user->id,
            'username' => $user->username,
            'email' => $user->email
        ), getenv("JWT_SECRET"));

        return $response->withJson(array(
            'token' => $token
        ));
    }
}
