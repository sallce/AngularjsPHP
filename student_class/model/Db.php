<?php

$servername='localhost';
$username='root';
$password='';
$dbname='marlabs';

$db = new Db($servername, $username,$password,$dbname);

class Db{
    private $cont;
    function __construct($servername, $username,$password,$dbname){
        $this->cont = mysqli_connect($servername, $username,$password,$dbname);
        if($this->cont->connect_error){
            die('Connection failed: '.$this->cont->connect_error);
        }
    }

    function get_all($table,$arr){
        $sql = "select * from $table where 1 ";
        foreach($arr as $key=>$value){
            $sql .= 'and '.$key.'="'.$value.'" ';
        }
        $index = 0;

        $returnData = array();

        $result = mysqli_query($this->cont, $sql);
        if($result){
            if(mysqli_num_rows($result) > 0){
                while($row = $result->fetch_assoc()){
                    $returnData[$index] = $row;
                    $index ++ ;
                }
            }
        }

        return $returnData;
    }


    function get_one($table,$arr){
        $sql = "select * from $table where 1 ";
        foreach($arr as $key=>$value){
            $sql .= 'and '.$key.'="'.$value.'" ';
        }

        $returnData = array();

        $result = $this->cont->query($sql);

        return $result->fetch_assoc();

    }

    function soft_delete($table,$arr){
        $timestamp = date('Y-m-d G:i:s');
        $sql = "update $table set delete_status=1, modified_date=$timestamp where 1 ";
        foreach($arr as $key=>$value){
            $sql .= 'and '.$key.'="'.$value.'" ';
        }


        return $sql;
    }

    function insert_data($table,$arr){
        $fields = '';
        $values = '';
        foreach($arr as $key=>$val){
            $fields .= $key.', ';
            $values .= '"'.$val.'", ';
        }
        $fields = substr($fields,0,-2);
        $values = substr($values,0,-2);

        $sql = "insert into $table ($fields) values ($values)";
        $result = $this->cont->query($sql);

        return $result;
    }

    function insert_student($arr){
        $student_name = $arr['student_name'];
        $student_email = $arr['student_email'];
        $class_id = $arr['class_id'];
        $grade = $arr['grade'];
        $sql = "insert into students (student_name,student_email) values ('$student_name','$student_email')";
        $result = $this->cont->query($sql);
        
        if($result){
            $last_id = $this->cont->insert_id;
            $sql2 = "insert into enrollment (class_id,student_id,grade) values('$class_id','$last_id','$grade' )";
            $result2 = $this->cont->query($sql2);

            return $result2;
        }else{
            return $result;
        }
    }


}

?>