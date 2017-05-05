<?php
header("Content-Type: application/json");

require_once('../model/Db.php');
session_start();


if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION) && !empty($_SESSION)){
    $student_name = $_POST['student_name'];
    $student_email = $_POST['student_email'];
    $class_id = $_POST['class_id'];
    $garde = $_POST['garde'];

    $new_student = array('student_name'=>$student_name,'student_email'=>$student_email,'class_id'=>$class_id,'grade'=>$garde);
    $data = array();

    $result = $db->insert_student($new_student);

    if($result){
        $data = array('statusmes'=>'success');
    }else{
        $data = array('statusmes'=>'error');
    }

    echo json_encode($data);
    flush();

}

?>