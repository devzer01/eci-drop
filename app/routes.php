<?php

$app->addRoutes([
    '/' => 'Home:index'
]);

$app->notFound(function () use ($app) {
    $app->redirect('/');
});
