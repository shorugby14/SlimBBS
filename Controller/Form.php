<?php
namespace BBS\Controller;
class Form{
    protected $container;
    function __construct($container){
        $this->container = $container;
    }
    function __invoke($request,$response){
        session_start();
        if(isset($_SESSION["name"])){
            $name = $_SESSION["name"];
        }else{
            $name = null;
        }
        return $this->container->view->render($response,'Form.twig',['name'=>$name]);
    }
}