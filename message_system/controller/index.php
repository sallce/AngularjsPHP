<?php
require_once('../model/Db.php');

$data=array('status'=>'400');


$fetchData=$db->get_all('user',array('password'=>'sadf'));

var_dump($fetchData);

?>