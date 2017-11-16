<?php
namespace BBS\Controller;
class PostHistory{
    protected $container;
    function __construct($container){
        $this->container = $container;
    }
    function __invoke($request,$response){
        try{
          $pdo = new \PDO("mysql:host =ip-10-107-41-199 ; dbname=bbs","root","",    
                         array(
                             \PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET 'utf8'"
                         ));      
        }catch (PDOException $e){
          die($e -> getMessage());
        }
        session_start();
        $login_id = $_SESSION["login_id"];
        $name = $_SESSION["name"];
        $sql = "SELECT * FROM boards WHERE login_id = $login_id";
        $result = $pdo->query($sql);
        $board = $result->fetchAll(\PDO::FETCH_ASSOC);
        return $this->container->view->render($response,'PostHistory.twig',['name'=>$name,'board'=>$board]);        
    }
}