<?php

namespace classes;

use classes\Connect;

class MessageConnect extends Connect
{

    protected $host = "mysql-service";
    protected $user = "root";
    protected $password = "secret";
    protected $database = "test";
    protected $port=3306;
    protected $conn;

    public function getMessages(){
        $result = parent::fetchAll("SELECT * FROM `messages`");
        $messages = [];
        for ($i = 0,$len=count($result); $i < len; $i++) {
            $messages[i]=new Message($result[$i]["id"],$result[$i]["message"]);
        }
        return $messages;
    }
    public function getMessage($id){
        $result = parent::fetchOne("SELECT * FROM `messages` WHERE id=:id",["id"=>$id]);
        return new Message($result["id"],$result["message"]);
    }
    public function newMessage($data){
        $rows = parent::execute("INSERT INTO `messages` (message) VALUES (:message)",[":message"=>$data]);
        if($rows){
            return $rows;
        }
        else{
            return false;
        }
    }

}