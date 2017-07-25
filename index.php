<?php

include_once('/classes/Database.php');

$server=$_SERVER['REQUEST_METHOD'];

SWITCH($server){
    case "GET":
        getEmployee();
        break;
    case "POST":
        insertEmployee();
        break;
    case "PUT":
        updateEmloyee();
        break;
    case "DELETE":
        deleteEmployee();
        break;
    default:
        http_response_code(400);
}


function getEmployee(){

    $db=\Database\Database::getInstance()->query();
    $q = "SELECT * FROM employee";
    $result = mysqli_query($db,$q);
    $data = array();

    while ($i = mysqli_fetch_assoc($result)) {
        $data[] = $i;
    }
    echo json_encode($data);
    http_response_code(200);

    }

function insertEmployee(){
    $db=\Database\Database::getInstance()->query();
    $data = json_decode(file_get_contents('php://input'), true);
    $username = $data["username"];
    $firstname = $data["firstname"];
    $lastname=$data["lastname"];
    $age=$data["age"];
    $q="INSERT INTO employee (username, firstname,lastname,age) values ('$username', '$firstname','$lastname','$age')";
    mysqli_query($db, $q);
    http_response_code(201);
}
function updateEmployee(){

    $db=\Database\Database::getInstance()->query();
    $data = json_decode(file_get_contents('php://input'), true);
    $id_employee=$data["id_employee"];
    $username = $data["username"];
    $firstname = $data["firstname"];
    $lastname=$data["lastname"];
    $age=$data["age"];

    $q="UPDATE employee SET username = '$username', firstname= '$firstname', lastname='$lastname', age='$age' WHERE id_employee = '$id_employee'";
    mysqli_query($db, $q);
    http_response_code(200);
}
function deleteEmployee(){

    $db=\Database\Database::getInstance()->query();
    $data = json_decode(file_get_contents('php://input'), true);
    $id_employee = $data["id_employee"];
    $q = "DELETE FROM employee WHERE id_employee = '$id_employee'";
    mysqli_query($db, $q);
    http_response_code(200);
}


