<?php
namespace BBS\Controller;
class ConfirmLog{
    protected $container;
    function __construct($container){
        $this->container = $container;
    }
    function __invoke($request,$response){
        if(empty($_POST["id"]) || empty($_POST["password"])){
            $error = "ユーザー名とパスワードを入力してください";
            return $this->container->view->render($response,'ConfirmLog.twig',['error'=>$error]);
        }
        try{
            $pdo = new \PDO("mysql:host = ip-10-107-41-199; dbname=bbs","root","",
                          array(
                             \PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET 'utf8'"
                          ));      
        }catch (PDOException $e){
            die($e -> getMessage());
        }
        session_start();
        $sql = "SELECT login_id,password,name FROM users WHERE login_id =:login_id AND password = :password";
        $stmt = $pdo->prepare($sql);;
        $result = $stmt->execute(array(':login_id'=>$_POST["id"],':password'=>$_POST["password"]));
        while($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
            $id = $row["login_id"];
            $pass = $row["password"];
            $name = $row["name"];
        }
        if(isset($id)){
            $success ="ログインに成功しました";
            $_SESSION["login_id"] = $_POST["id"];
            $_SESSION["name"] = $name;
        }else{
            $success = "ユーザー名かパスワードが正しくありません";
        }
        return $this->container->view->render($response,'ConfirmLog.twig',['success'=>$success]);
    }
}
?>