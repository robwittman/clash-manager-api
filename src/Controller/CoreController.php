<?php

namespace Clash\Controller;

class CoreController
{
    protected static $permissions = array();

    /**
     * Get required permissions for the current route
     * @param  string $function
     * @return array
     */
    public static function getRoutePermissions($function)
    {
        if (isset(static::$permissions[$function])) {
            $perms = static::$permissions[$function];
            if (is_array($perms)) {
                return $perms;
            }
            return array($perms);
        }
        return array();
    }
}
