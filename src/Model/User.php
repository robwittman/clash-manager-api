<?php

namespace Clash\Model;

use Clash\Model\Permission;

class User extends Elegant
{
    public $table = 'users';

    protected $hidden = array(
        'password'
    );

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = password_hash($password, PASSWORD_BCRYPT);
    }

    public function authenticate($password)
    {
        return password_verify($password, $this->attributes['password']);
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'users_permissions');
    }

    public function hasPermissions(array $requiredPermissions)
    {
        foreach ($requiredPermissions as $req) {
            $found = false;
            foreach ($this->permissions as $perm) {
                if ($perm->name == $req) {
                    $found = true;
                }
            }
            if (!$found) {
                return false;
            }
        }

        return true;
    }
}
