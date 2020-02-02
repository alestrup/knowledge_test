<?php

//header('Access-Control-Allow-Origin: *');  /* As Best practice , we should manage it with CORS */
require(ROOT . 'Models/Student.php');

class UsersController extends Controller
{
    public function index($limit= 5, $current_page = 1)
    {
        /* As a Best practice the url should be into a global config file */
        $url = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['SERVER_NAME'].strtok($_SERVER["REQUEST_URI"],'?');

        $limit = intval($limit);
        $current_page = intval($current_page);

        $this->verifySession(); /* Call this method in every method that needs a session to retrieve data */

        $students = new Student();

        $total_pages = intval($students->getTotalStudentsPages($limit));
        $response = $students->showAllStudents($limit, $current_page);
        
        $next_page = null;
        $prev_page = null;

        if($current_page < $total_pages)
            $next_page = $url . "?limit=".$limit."&current_page=" . ($current_page + 1);
        
        if($current_page > 1)
            $prev_page = $url . "?limit=".$limit."&current_page=" . ($current_page - 1);
        
        echo json_encode(
            [
                "per_page" => $limit,
                "current_page" => $current_page,
                "last_page" => $total_pages ,
                "first_page_url" => $url . "?limit=".$limit."&current_page=1",
                "last_page_url" => $url . "?limit=".$limit."&current_page=" . $total_pages,
                "next_page_url" => $next_page,
                "prev_page_url" => $prev_page,
                "data" => $response
            ]
        );

    }
}
?>