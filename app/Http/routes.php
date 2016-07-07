<?php

$app->get('/login', ['as' => 'login', function () {
    return view('pages.login');
}]);

$app->get('/register', ['as' => 'register', function () {
    return view('pages.register');
}]);

$app->get('/forgot', ['as' => 'forgot', function () {
    return view('pages.forgot');
}]);

$app->get('/terms', ['as' => 'terms', function () {
    return 'Nothing to agree with';
}]);

$app->get('/privacy', ['as' => 'privacy', function () {
    return 'Shortest privacy';
}]);

