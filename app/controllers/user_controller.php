<?php

class UserController extends BaseController{
    
    public static function login(){
        View::make('user/login.html');
    }
    
    public static function handle_login(){
        $params= $_POST;
        
        $counsellor = Counsellor::authenticate($params['username'], $params['password']);
        
        if(!$counsellor) {
            View::make('user/login.html', array('message' => 'Väärä käyttäjätunnus tai salasana!', 'username' => $params['username']));
        } else {
            $_SESSION['counsellor'] = $counsellor->id;
            
            Redirect::to('/', array('message' => 'Kirjautuneena tunnuksella ' . $counsellor->username . '!'));
        }
    }
    
    public static function logout(){
        $_SESSION['counsellor'] = null;
        Redirect::to('/login', array('message' => 'Olet ulkona!'));
    }
}

