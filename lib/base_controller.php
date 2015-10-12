<?php

  class BaseController{

    public static function get_user_logged_in(){
      
       if(isset($_SESSION['counsellor'])) {
            $counsellor_id = $_SESSION['counsellor'];
            
            $counsellor = Counsellor::find($counsellor_id);
            
            return $counsellor;
        } 
        
      return null;
    }

    public static function check_logged_in(){
        if (!isset($_SESSION['counsellor'])){
            Redirect::to('/login', array('message' => 'Kirjaudu ensin sisään!'));
        }
    }

  }
