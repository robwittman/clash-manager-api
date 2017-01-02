<?php

$app->get('/clan', 'ClanController:show');
$app->get('/clan/warlog', 'WarLogController:index');
