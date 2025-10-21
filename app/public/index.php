<?php

use classes\Connect;


require_once 'classes/Connect.php';
require_once 'classes/MessageConnect.php';
require_once 'classes/Message.php';

$db = new \classes\MessageConnect('mysql-service', 'root', 'secret','test',3306);
$db->connect();
$m = $db->getMessage(1);
$m->printMessage();
$db->disconnect();
?>
