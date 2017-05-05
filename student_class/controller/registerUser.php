<?php

header("Content-Type: application/json");
require_once('../model/Db.php');

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);

    $data_arr = array(
        'username' => $request->username,
        'password' => $request->password,
        'primary_email' => $request->primary_email,
        'lastname' => $request->lastname,
        'firstname' => $request->firstname
    );
    

    $result = $db->insert_data('user',$data_arr);

    if($result){
        $data = array('statusmes'=>'success');
    }else{
        $data = array('statusmes'=>'error');
    }

    echo json_encode($data);

    flush();
}

?>