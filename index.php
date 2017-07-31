<?php

include_once('/classes/Rest.php');
include_once('/classes/Auth.php');
include_once('/classes/Database.php');
$db=\Database\Database::getInstance()->query();
$request_method=$_SERVER['REQUEST_METHOD'];

switch($request_method) {
    case "GET":
        if ($_GET['url'] == "employee") {
            if (isset($_GET['token'])) {
                $token = $_GET['token'];

                $q = "SELECT token FROM token WHERE token='$token'";
                $result = mysqli_query($db, $q);
                if (mysqli_num_rows($result)) {
                    \Rest\Rest::getEmployee();
                }
            }
        }
        break;
    case "POST":
        if ($_GET['url'] == "auth") {
            \Auth\Auth::login();
            if (isset($_GET['token'])) {
                $token = $_GET['token'];

                $q = "SELECT token FROM token WHERE token='$token'";
                $result = mysqli_query($db, $q);
                if (mysqli_num_rows($result)) {
                    \Rest\Rest::getEmployee();
                }
            }
        } else if ($_GET['url'] == 'employee') {
            if (isset($_GET['token'])) {
                $token = $_GET['token'];
                $q = "SELECT token FROM token WHERE token='$token'";
                $result = mysqli_query($db, $q);
                if (mysqli_num_rows($result)) {
                    \Rest\Rest::insertEmployee();
                }
            }
        }
        break;
    case "PUT":
        if ($_GET['url'] == 'employee') {
            if (isset($_GET['token'])) {
                $token = $_GET['token'];
                $q = "SELECT token FROM token WHERE token='$token'";
                $result = mysqli_query($db, $q);
                if (mysqli_num_rows($result)) {
                    \Rest\Rest::updateEmployee();
                }
            }
        }
    break;
    case "DELETE":
        if ($_GET['url'] == 'employee'){
            if(isset($_GET['token'])) {
                $token = $_GET['token'];
                $q = "SELECT token FROM token WHERE token='$token'";
                $result = mysqli_query($db, $q);
                if (mysqli_num_rows($result)) {
                    \Rest\Rest::deleteEmployee();
                }
            }
        }
    break;
    default:
        http_response_code(400);

}




