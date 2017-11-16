<?php
require 'vendor/autoload.php';

$app = new \Slim\App();
$container = $app->getContainer();

//ルーティングの設定
$app->get('/',BBS\Controller\Top::class);
$app->get('/Form',BBS\Controller\Form::class);
$app->post('/PostMsg',BBS\Controller\PostMsg::class);
$app->get('/Top',BBS\Controller\Top::class);
$app->get('/Login',BBS\Controller\Login::class);
$app->post('/ConfirmLog',BBS\Controller\ConfirmLog::class);
$app->get('/Logout',BBS\Controller\Logout::class);
$app->get('/PostHistory',BBS\Controller\PostHistory::class);
$app->post('/Good',BBS\Controller\Good::class);
$app->post('/ViewGood',BBS\Controller\ViewGood::class);

$container['view'] = function($container){
    return new \Slim\Views\Twig(__DIR__.'/templates/');
};
$app->run();
