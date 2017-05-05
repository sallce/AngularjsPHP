<?php
header("Content-Type: application/json");
require_once('../model/Db.php');
session_start();
$data=array('statusmes'=>'error');

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION) && !empty($_SESSION)){

    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);
    $table_name = $request->table;
    $message_id = $request->id;
    
    $result = $db->soft_delete($table_name,array('id'=>$message_id));

    // array('id'=>$message_id,'table_name'=>$table_name)
    echo json_encode(array('sql'=>$result));
    flush();
}

?>