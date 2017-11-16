<?php
namespace BBS\Controller;
class Good{
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
        $sql = "INSERT INTO good (id,login_id,name) VALUES (:id,:login_id,:name)";
        $stmt = $pdo->prepare($sql);
        if(isset($_SESSION["login_id"])){
            $id = $_POST["id"];
            $login_id = $_SESSION["login_id"];
            $name = $_SESSION["name"];
        }else{
            $success = "ログインしてください";
            return $this->container->view->render($response,'Good.twig',['success'=>$success]);
        }
        $result = $stmt->execute(array(':id'=>$id,':login_id'=>$login_id,':name'=>$name));
        if(isset($result)){
            $success = "いいね!!!!しました";
        }else{
            $success = "いいね!!!!に失敗しました。やり直してください";
        }
        return $this->container->view->render($response,'Good.twig',['success'=>$success]);
    }
}