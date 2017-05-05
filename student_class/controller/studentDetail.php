<?php
header("Content-Type: application/json");
require_once('../model/Db.php');
session_start();

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION) && !empty($_SESSION)){
    $student_id = $_POST['student_id'];

    $data = $db->get_all('students s inner join enrollment e on(e.student_id = s.student_id) inner join class c on(e.class_id=c.class_id)',array('s.student_id'=>$student_id));

    echo json_encode($data);

    flush();
}
?>