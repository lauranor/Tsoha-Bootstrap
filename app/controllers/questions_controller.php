<?php

class QuestionController extends BaseController{
    public static function index() {
        $questions = Question::all();
        
        View::make('question/index.html', array('questions' => $questions));
    }
}

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

