<?php 
/**
 * Sesstion class
 * */ 

 class Sesstion{
    /**
     * sesstion start method
     * */ 
    public static function init(){
        session_start();
    }

    /**
     * sesstion set method
     * */ 
    public static function set($key, $value){
        $_SESSION[$key] = $value;
    }

    /**
     * sesstion get method 
     * */ 
    public static function get($key){
        if(isset($_SESSION[$key])){
            return $_SESSION[$key];
        }else{
            return false;
        }
    }

    /**
     * sesstion checked 
     * */ 
    public static function checkSesstion(){
        self::init();
        if(self::get("login") == false){
            self::destroy();
            header("location:login.php");
        }
    }

    /** 
     * sesstion destroy
     * */ 

    public static function destroy(){
        session_destroy();
        header("location:login.php");
    }
 }