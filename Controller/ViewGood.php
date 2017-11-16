<?php
namespace BBS\Controller;
class ViewGood{
    protected $container;
    protected $sql;
    protected $pdo;
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
        $_SESSION["id"] = $_POST["id"];
        $id = $_SESSION["id"];
        $sql = "SELECT name FROM good WHERE id = $id";
        $result = $pdo->query($sql);
        $good = $result->fetchAll(\PDO::FETCH_ASSOC);
        return $this->container->view->render($response,'ViewGood.twig',['good'=>$good]);
    }
}
