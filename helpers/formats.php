<?php 
/**
 * Date Formates
 * 
*/

class Format {
    public function getDate($date){
        return date("m, d, F h:i:s", strtotime($date));
    }

    /**
     * dame text fix word return
     * */ 
    public function textCount($bodyText, $limit = 400){
        $text = $bodyText . " ";
        $text  = substr($bodyText, 0, $limit);
        $text  = substr($bodyText, 0, strripos($text, ' '));
        $text = $text . "...";
        return $text;
    }   


    /**
     * login input validation
     * */ 

     public function validation($inputData){
        $inputData = trim($inputData);
        $inputData = htmlspecialchars($inputData);
        $inputData = stripslashes($inputData);
        return $inputData;
     }

    /**
     * url path title dynamic 
     * */  
    public function title(){
        $path = $_SERVER['SCRIPT_FILENAME'];
        $title = basename($path, ".php");

        $title = str_replace("_", " ", $title);

        if($title == "index"){
            $title = "home";
        }elseif($title == "contact"){
            $title = "contact";
        }
        return $title = ucwords($title);
    }
}

?>