<?php

header("Content-Type: application/json");
require_once('../model/Db.php');

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);
    $username = $request->username;

    $result = $db->get_one('user',array('username'=>$username));
    if($result){
        $data = array('statusmes'=>'error');
    }else{
        $data = array('statusmes'=>'success');
    }
    echo json_encode($data);

    flush();
}

?>