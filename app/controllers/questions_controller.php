<?php

class QuestionController extends BaseController{
    public static function index() {
        $questions = Question::all();
        
        View::make('home.html', array('questions' => $questions));
    }
    
    public static function show($id) {
        $question = Question::find($id);
        
        View::make('question/show_question.html', array('question' => $question));
    }
    
    public static function ask() {
        View::make('question/new.html');
    }
    
    public static function store() {
        $params = $_POST;
   
        $question= new Question(array(
            
            'questiontext' => $params['questiontext'],
            'title' => $params['title']
            
        ));
        
        
        Kint::dump($params);
        
        $question->save();
        
        Redirect::to('/', array('message' => 'Kiitos, kysymyksesi on nyt lähetetty!'));
    }
    
    public static function edit($id) {
        $question = Question::find($id);
        View::make('question/edit.html', array('question' => $question));
    }
    
    public static function update($id) {
        $params = $_POST;
        
        $attributes = array(
            'id' => $id,
            'title' => $params['title'],
            'questiontext' => $params['questiontext']
        );
        
        $question = new Question($attributes);
        $errors = $question->errors();
        
        if(count($errors) > 0){
            View::make('question/edit.html', array('errors' => $errors, 'attributes'=> $attributes));
        }
        else {
            $question->update();
            
            Redirect::to('/', array('message' => 'Kysymystä on muokattu onnistuneesti!'));
        }
    }
    
    public static function destroy($id) {
        $question = new Question(array('id' => $id));
        
        $question->destroy();
        
        Redirect::to('/game', array('message' => 'Peli on poistettu onnistuneesti!'));
    }
}



