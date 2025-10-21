<?php
namespace classes;
class Message {
    private $id;
    public $message;
    public function __set($id, $value)
    {
        $this->id = $id;
    }
    public function __construct($id, $message){
        $this->message = $message;
        $this->id = $id;
    }
    public function printMessage(){
        echo $this->message;
    }
}