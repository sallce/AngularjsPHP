<?php

header("Content-Type: application/json");
session_start();
$_SESSION = array();;

session_destroy();

echo json_encode(array('statusmes'=>'ok'));
flush();

?>