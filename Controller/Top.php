<?php
namespace BBS\Controller;
class Top{
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
        if(isset($_SESSION["name"])){
            $name = $_SESSION["name"];
        }else{
            $name  = null;
        }
        $sql = "SELECT * FROM boards";
        $result = $pdo->query($sql);
        $board = $result->fetchAll(\PDO::FETCH_ASSOC); 
        
        $number = count($board);
        foreach($board as $row){
            $rowid = $row['id'];
            for($i = 1;$i<=$number;$i++){
                $count_sql = "SELECT COUNT(id) FROM good WHERE id= $rowid";
                $count_result = $pdo->query($count_sql);
                $count[] = $count_result->fetchColumn();
            }
        }
        return $this->container->view->render($response,'Top.twig',['name'=>$name,'board'=>$board,'count'=>$count]);
    }
}
