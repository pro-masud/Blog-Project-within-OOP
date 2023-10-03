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
        $text = $text . "...";
        return $text;
    }   
}

?>