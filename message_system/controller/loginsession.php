<?php
header("Content-Type: application/json");
require_once('../model/Db.php');
session_start();
$data=array('statusmes'=>'error');

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    
    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);
    $username = $request->username;
    $pass = $request->password;


    if(isset($request->username) && !empty($request->username) && isset($request->password) && !empty($request->password)){
        $fetchData=$db->get_all('user',array('username'=>$username));

        foreach ($fetchData as $row) {
            if($row['password'] == $pass){
                $data = array('statusmes'=>'ok');
                $_SESSION['user_id'] = $row['user_id'];
                $_SESSION['username'] = $row['username'];
                break;
            }
        }

    }else{
        $data=array('statusmes'=>'No post data');
    }
    
}else if($_SERVER['REQUEST_METHOD'] === 'GET'){
    if(isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])){
        $data=array('statusmes'=>$_SESSION['user_id']);        
    }else{
        $data = array('statusmes'=>'error');
    }
}

echo json_encode($data);
flush();
?>