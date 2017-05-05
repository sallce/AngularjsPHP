<?php
header("Content-Type: application/json");
require_once('../model/Db.php');
session_start();

if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_SESSION) && !empty($_SESSION)){
    $user_id = $_SESSION['user_id'];

    $data = $db->get_one('`user` ',array('user_id'=>$user_id));

    echo json_encode($data);

    flush();
}
?>