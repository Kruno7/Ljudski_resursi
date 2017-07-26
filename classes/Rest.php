<?php

namespace Rest;
use Database\Database;
include_once("Database.php");


class Rest
{

    public static function getEmployee(){
        $db=Database::getInstance()->query();
        $q = "SELECT * FROM employee";
        $result = mysqli_query($db,$q);
        $data = array();

        while ($i = mysqli_fetch_assoc($result)) {
            $data[] = $i;
        }
        echo json_encode($data);
        http_response_code(200);
    }
    public static function insertEmployee(){
        $db=\Database\Database::getInstance()->query();
        $data = json_decode(file_get_contents('php://input'), true);
        $username = mysqli_real_escape_string($db,$data["username"]);
        $firstname = mysqli_real_escape_string($db,$data["firstname"]);
        $lastname=mysqli_real_escape_string($db,$data["lastname"]);
        $age=mysqli_real_escape_string($db,$data["age"]);
        $q="INSERT INTO employee (username, firstname,lastname,age) values ('$username', '$firstname','$lastname','$age')";
        mysqli_query($db,$q);
        http_response_code(201);
    }
    public static function updateEmployee(){

        $db=\Database\Database::getInstance()->query();
        $data = json_decode(file_get_contents('php://input'), true);
        $id_employee=$data["id_employee"];
        $username = mysqli_real_escape_string($db,$data["username"]);
        $firstname = mysqli_real_escape_string($db,$data["firstname"]);
        $lastname=mysqli_real_escape_string($db,$data["lastname"]);
        $age=mysqli_real_escape_string($db,$data["age"]);

        $q="UPDATE employee SET username = '$username', firstname= '$firstname', lastname='$lastname', age='$age' WHERE id_employee = '$id_employee'";
        mysqli_query($db, $q);
        http_response_code(200);
    }
    public static function deleteEmployee(){

        $db=\Database\Database::getInstance()->query();
        $data = json_decode(file_get_contents('php://input'), true);
        $id_employee = $data["id_employee"];
        $q = "DELETE FROM employee WHERE id_employee = '$id_employee'";
        mysqli_query($db, $q);
        http_response_code(200);
    }

}

