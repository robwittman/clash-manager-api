<?php

namespace Clash\Controller;

use Clash\Model\User;
use Clash\Helper\JsonHelper;
use Clash\Model\Permission;

class Usercontroller extends CoreController
{
    protected static $permissions = array(
        'index' => 'manage_users',
        'show' => 'manage_users',
        'create' => 'manage_users',
        'update' => 'manage_users',
        'permissions' => 'manage_users',
        'delete' => 'manage_users'
    );

    public function index($request, $response)
    {
        $users = User::all();

        return JsonHelper::respond($response, array('users' => $users));
    }

    public function show($request, $response, $arguments)
    {
        $user = User::with('permissions')->find($arguments['id']);
        
        return JsonHelper::respond($response, array('user' => $user));
    }

    public function create($request, $response)
    {
        $params = $request->getParsedBody();
        $user = new User();
        $user->email = $params['email'];
        $user->username = $params['username'];
        $user->password = $params['password'];

        try {
            $user->save();
        } catch (\Exception $e) {
            return JsonHelper::respondWithError($response, $e->getMessage(), 400);
        }

        $permissions = explode(',', $params['permissions']);
        foreach ($permissions as $permission) {
            $perm = Permission::where('name', $permission)->first();
            $user->permissions()->attach($perm->id);
        }

        return JsonHelper::respond($response, $user);
    }

    public function permissions($request, $response, $arguments)
    {
        $user = User::find($arguments['id']);
        if (empty($user)) {
            return JsonHelper::respondWithNotFound($response);
        }

        $permissions = array();

        $params = $request->getParsedBody();
        $perms = explode(',', $params['permissions']);

        foreach ($perms as $perm) {
            $permission = Permission::where('name', $perm)->first();
            array_push($permissions, $permission->id);
        }

        $user->permissions()->sync($permissions);

        return JsonHelper::respond($response, array('success' => true));
    }

    public function delete($request, $response, $arguments)
    {
        $user = User::find($arguments['id']);
        $user->delete();
        return JsonHelper::respond($response, array('success' => true));
    }
}
