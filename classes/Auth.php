<?php


namespace Auth;
require_once('vendor/autoload.php');
include_once("Database.php");
use Database\Database;
use \Firebase\JWT\JWT;

class Auth
{
    public $id;
    public $id_user;
    public $token;

    public static function login(){

            $db = \Database\Database::getInstance()->query();
            $data = json_decode(file_get_contents('php://input'), true);

            $username = mysqli_real_escape_string($db,$data["username"]);
            $password = mysqli_real_escape_string($db,$data["password"]);

            $q = " Select * from users where username = '" . $username . "' AND password ='" . $password . "' ";
            $result = mysqli_query($db, $q);
            $no_rows = mysqli_num_rows($result);
            $user_data=mysqli_fetch_assoc($result);
            $id_user=$user_data['id_user'];

            if ($no_rows > 0) {
                echo "Success";

                $true = True;
                $token = bin2hex(openssl_random_pseudo_bytes(64, $true));
                $auth=new Auth();
                $auth->id_user=$id_user;
                $auth->token=$token;

               // $sql="INSERT INTO token (id_user,token) VALUES ('$id_user','$token')";
               // $result=mysqli_query($db,$sql);

                }
        else{
            http_response_code(401);
        }

            }

}

