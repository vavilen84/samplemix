<?php

$params = [
    'adminEmail' => 'admin@example.com',
];
$localParams = include('params-local.php');

return array_merge($params, $localParams);
