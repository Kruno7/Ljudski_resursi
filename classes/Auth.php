<?php


namespace Auth;
require_once('vendor/autoload.php');
include_once("Database.php");
use \Firebase\JWT\JWT;

class Auth
{
    public static function login(){

            $db = \Database\Database::getInstance()->query();
            $data = json_decode(file_get_contents('php://input'), true);
            $username = mysqli_real_escape_string($db,$data["username"]);
            $password = mysqli_real_escape_string($db,$data["password"]);

            $q = " Select * from users where username = '" . $username . "' AND password ='" . $password . "' ";
            $result = mysqli_query($db, $q);
            $no_rows = mysqli_num_rows($result);
            $user_data=mysqli_fetch_assoc($result);

            if ($no_rows > 0) {

                    $tokenId = base64_encode(mcrypt_create_iv(32));
                    $issuedAt = time();
                    $notBefore = $issuedAt + 10;
                    $expire = $notBefore + 60;

                    $data = [
                        'iat'  => $issuedAt,
                        'jti'  => $tokenId,
                        'nbf'  => $notBefore,
                        'exp'  => $expire,
                        'data' => [
                            'userId'   => $user_data['id_user'],
                            'userName' => $username,
                        ]
                    ];

                $secretKey=base64_decode($tokenId);
                $jwt = JWT::encode(
                    $data,
                    $secretKey,
                    'HS512'
                );

                $unencodedArray = ['jwt' => $jwt];
                echo json_encode($unencodedArray);

                }

            }
}

