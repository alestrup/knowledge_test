<?php

//header('Access-Control-Allow-Origin: *');  /* As Best practice , we should manage it with CORS */
require_once(ROOT . 'Models/User.php');

class AuthController extends Controller
{
    public function index()
    {
        $parameters = json_decode(file_get_contents('php://input'));

        if(isset($parameters->email) && isset($parameters->password)){
            $user = new User();
            $response = $user->showUser($parameters->email);
            if($response != null){
                if($response['password'] == openssl_encrypt($parameters->password, "AES-128-ECB", $user::password_hash) ){
                    /* For best practices, we can use here a Bearer Token and send it via Header , for it i will use a simple token. */
                    $remember = 0;
                    if(isset($parameters->remember)){
                            $remember = intval($parameters->remember);
                    }
                    $token = md5(uniqid($response["id"], true));
                    $last_activity = time();
                    $session = new Session();

                    /* Expiring old sessions */
                    $session->deleteAllSessions($response["id"]);

                    /* Create a new session */
                    $session->create($response["id"], $token, $last_activity, $remember);

                    echo( 
                        json_encode(
                            [
                                "session" => [
                                    "user_id" => $response["id"],
                                    "token" => $token,
                                    "last_activity" => $last_activity,
                                    "remember" => $remember
                                ]
                            ]
                        )
                    );
                }
                else{
                    http_response_code(401);
                }
            }
            else{
                http_response_code(401);
            }
        }
        else{
            http_response_code(400);
        }

    }

    /* FOR BEST PRACTICES: This call should be a POST but in the test it's requested as DELETE */
    public function logout(){
        $headers = getallheaders();
        
        if(isset($headers['userId']) && isset($headers['token'])){
            $session = new Session();
            echo json_encode($session->deleteSession($headers['token'],$headers['userId']));
        }
        else{
            http_response_code(400);
        }
    }

    /* Method to create a User for test */
    // function create()
    // {
    //     $parameters = json_decode(file_get_contents('php://input'));
    //     $user= new User();
    //     var_dump($user->create($parameters->name, $parameters->lastname, $parameters->email, $parameters->password));
    // }
}
?>