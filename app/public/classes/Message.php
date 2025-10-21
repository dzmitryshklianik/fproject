<?php
namespace classes;
class Message {
    private $message_id;
    public $message;
    public function __set($m_id, $value)
    {
        $this->message_id = $m_id;
    }
    public function __construct($m_id, $message){
        $this->message = $message;
        $this->message_id = $m_id;
    }
    public function printMessage(){
        echo $this->message;
    }
}