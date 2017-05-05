<?php
header("Content-Type: application/json");
require_once('../model/Db.php');
session_start();

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION) && !empty($_SESSION)){

    $class_id = $_POST['class_id'];
    $data = $db->get_all('enrollment e inner join students s on(e.student_id=s.student_id) ' , ['e.class_id'=>$class_id]);
    
    echo json_encode($data);

    flush();
}


?>