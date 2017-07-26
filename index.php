<?php

include_once('/classes/Rest.php');

$request_method=$_SERVER['REQUEST_METHOD'];

switch ($request_method) {
    case "GET":
        $rest=\Rest\Rest::getEmployee();
        break;
    case "POST":
        $rest=\Rest\Rest::insertEmployee();
        break;
    case "PUT":
        $rest=\Rest\Rest::updateEmployee();
        break;
    case "DELETE":
        $rest=\Rest\Rest::deleteEmployee();
        break;
    default:
        http_response_code(400);
}



