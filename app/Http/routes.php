<?php

$app->get('/', ['as' => 'login', function () {
    return view('index');
}]);

$app->post('/login', ['as' => 'login','uses' => 'AuthController@login']);

$app->get('/register', ['as' => 'register', function () {
    return view('pages.register');
}]);

