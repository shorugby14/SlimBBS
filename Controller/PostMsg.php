<?php
namespace BBS\Controller;
class PostMsg{
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
        $sql = "INSERT INTO boards (login_id,name,message) VALUES (:login_id,:name,:message)";
        $stmt = $pdo->prepare($sql);
        if(isset($_SESSION["login_id"])){
            $name = $_SESSION["name"];
            $login_id = $_SESSION["login_id"];
        }else{
            $name = $_POST["name"];
            $login_id = GUEST;
        }
        $msg = $_POST["msg"];
        $result = $stmt->execute(array(':login_id'=>$login_id,':name'=>$name,':message'=>$msg));
        if($result == false){
            $success = "投稿に失敗しました";
        }else{
            $success = "投稿しました";
        }
        return $this->container->view->render($response,'PostMsg.twig',['success'=>$success]);
    }
}
