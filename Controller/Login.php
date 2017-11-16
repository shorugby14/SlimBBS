<?php
namespace BBS\Controller;
class Login{
    protected $container;
    function __construct($container){
        $this->container = $container;
    }
    function __invoke($request,$response){
        return $this->container->view->render($response,'Login.twig');
    }
}