<?php

class AnswerController extends BaseController {
    
    public static function answer($id) {
        self::check_logged_in();
        $question = Question::find($id);
        
        View::make('answer.html', array('question' => $question));
    }
    
    public static function store() {
        $params = $_POST;
        
        
        $answer = new Answer(array(
            'answertext' => $params['answertext'],
            'question_id' => $params['question_id']
        ));
        
        $answer->save();
        
        //QuestionController::mark_as_read($params['question_id']);
        
        Redirect::to('/', array('message' => 'Vastauksesi on nyt lisätty.'));
    }
}


