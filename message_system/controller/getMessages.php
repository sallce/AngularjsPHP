<?php
header("Content-Type: application/json");
require_once('../model/Db.php');
session_start();

if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_SESSION) && !empty($_SESSION)){
    $user_id = $_SESSION['user_id'];
    $username = $_SESSION['username'];

    // $data = $db->get_all('inbox_messages im inner join user u on(im.oppouser_id=u.user_id) ',array('im.user_id'=>$user_id));
    $data = array(
        'inbox' => $db->get_all('inbox_messages im inner join user u on(im.oppouser_id=u.user_id) ',array('im.user_id'=>$user_id,'im.delete_status'=>0)),
        'sent' => $db->get_all('sent_messages sm inner join user u on(sm.oppouser_id=u.user_id) ',array('sm.user_id'=>$user_id,'sm.delete_status'=>0)),
        'username' => $username
    );

    echo json_encode($data);

    flush();
}




?>