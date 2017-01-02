<?php

$app->get('/members', 'MemberController:index');
$app->get('/members/{playerTag}', 'MemberController:show');
