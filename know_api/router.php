<?php

class Router
{

    static public function parse($url, $request)
    {
        $url = trim($url);
        $explode_url = explode('/', $url);
        $explode_url = array_slice($explode_url, 2);

        $request->controller = strtok($explode_url[0],'?');

        switch($request->controller){
            case 'users':
                switch($request->method){
                    case 'GET':
                        $request->action = 'index';
                        break;
                }
                break;
            case 'auth':
                switch($request->method){
                    case 'POST':
                        $request->action = 'index';
                        break;
                    case 'DELETE': /* FOR BEST PRACTICES: This call should be a POST but in the test it's requested as DELETE */
                        $request->action = 'logout';
                        break;
                }
                break;
            default: $request->action = null;        
        }

        $url_components = parse_url($url); 
        if(array_key_exists('query', $url_components)){
            parse_str($url_components['query'], $request->params);
        }
        else{
            $request->params = [];
        }

    }
}
?>