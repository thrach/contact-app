<?php

$app->get('/', function () {
    return view('index');
});

$app->post('login', ['as' => 'login','uses' => 'AuthController@login']);
$app->post('register', ['as' => 'register','uses' => 'AuthController@register']);


