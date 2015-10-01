<?php

//require 'app/models/student.php';

class HelloWorldController extends BaseController {

    public static function index() {
        // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
//        View::make('home.html');
        //  echo 'Tämä on etusivu!';
        $questions = Question::all();
        
        View::make('home.html', array('questions' => $questions));
    }

    public static function sandbox() {
        $joku= Student::find(1);
        $henkilot = Student::all();
        
        Kint::dump($henkilot);
        Kint::dump($joku);
        
//        View::make('helloworld.html');
    }

    public static function login() {
        View::make('suunnitelmat/login.html');
    }

    public static function esittely() {
        View::make('suunnitelmat/esittely.html');
    }
    
    public static function ask() {
        View::make('suunnitelmat/ask.html');
    }

}
