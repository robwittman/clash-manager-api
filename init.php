<?php

require_once 'vendor/autoload.php';

$data = array();

$user = new Clash\Model\User();

foreach ($argv as $args) {
    if (strpos($args, ":") !== false) {
        $chunks = explode(':', $args);
        $user->{$chunks[0]} = $chunks[1];
    }
}

$user->save();
