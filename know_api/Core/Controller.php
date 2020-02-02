<?php

require_once(ROOT . 'Models/Session.php');

class Controller
    {
        var $vars = [];

        protected function set($d)
        {
            $this->vars = array_merge($this->vars, $d);
        }

        protected function verifySession()
        {
            $headers = getallheaders();

            if(isset($headers['userId']) && isset($headers['token'])){
                $session = new Session();
                $active_session = $session->getSession($headers['token'],$headers['userId']);
                $current_time = time();
                if(!$active_session){

                    /* No Active Session */
                    http_response_code(401);
                    die();
                }
                else{
                    $time_elapsed = $current_time - $active_session["last_activity"];

                    /* For best practices: Life session timeout is 15 minutes for session without remember me and 30 days with remember me */

                    if($active_session['remember'] == 1){
                        /* Expire session if the time exceed the 30 days */
                        if ( round($time_elapsed / 86400) > 30){
                            http_response_code(401);
                            die();
                        }
                    }
                    else{
                        if( ( $time_elapsed ) / 60 > 15 ){
                            /* Expire session if the time exceed the 15 minutes */
                            $session->deleteSession($headers['token'],$headers['userId']);
                            http_response_code(401);
                            die();
                        }
                    }

                    /* Refreshing the last_activity for the active session */
                    $session->updateSession($headers['token'],$headers['userId'],$current_time);
                }
            }
            else{
                http_response_code(401);
                die();
            }
    
        }
    }
?>
