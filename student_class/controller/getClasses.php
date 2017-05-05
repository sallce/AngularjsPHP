<?php
header("Content-Type: application/json");
require_once('../model/Db.php');
session_start();

if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_SESSION) && !empty($_SESSION)){

    $data = $db->get_all('class' , ['delete_status'=>0]);
    echo json_encode($data);

    flush();
}


?>