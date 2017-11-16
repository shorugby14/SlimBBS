<?php
namespace BBS\Controller;
class Logout{
    protected $container;
    function __construct($container){
        $this->container = $container;
    }
    function __invoke($request,$response){
        session_start();
        unset($_SESSION["login_id"]);
        unset($_SESSION["name"]);
        $logout = "ログアウトしました";
        return $this->container->view->render($response,'Logout.twig',['logout'=>$logout]);
    }
}
