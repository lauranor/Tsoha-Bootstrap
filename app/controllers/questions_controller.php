<?php

class QuestionController extends BaseController {

    public static function index() {
        $questions = Question::all();

        View::make('home.html', array('questions' => $questions));
    }

    public static function show($id) {
        $question = Question::find($id);

        View::make('question/show_question.html', array('question' => $question));
    }

    public static function ask() {
        $categories = Category::all();

        View::make('question/new.html', array('categories' => $categories));
    }

    public static function store() {
        $params = $_POST;

        $category = $params['category'];

        $question = new Question(array(
            'questiontext' => $params['questiontext'],
            'title' => $params['title'],
            'nametext' => $params['nametext'],
            'category_id' => $category
        ));
        $errors = $question->errors();

        Kint::dump($errors);

        if (count($errors) > 0) {
            View::make('question/new.html', array('errors' => $errors, 'question' => $question));
        } else {
            $question->save();

            Redirect::to('/', array('message' => 'Kiitos, kysymyksesi on nyt lähetetty!'));
        }
    }

    public static function edit($id) {
        self::check_logged_in();
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

        Kint::dump($errors);

        if (count($errors) > 0) {
            View::make('question/edit.html', array('errors' => $errors, 'attributes' => $attributes));
        } else {
            $question->update($id);

            Redirect::to('/', array('message' => 'Kysymystä on muokattu onnistuneesti!'));
        }
    }

    public static function destroy($id) {
        self::check_logged_in();
        $question = new Question(array('id' => $id));

        $question->destroy($id);

        Redirect::to('/', array('message' => 'Kysymys on nyt poistettu.'));
    }
    
    public static function mark_as_read($id) {
        $question = Question::find($id);
        
        $question->answered();
        
        Redirect::to('/', array('message' => 'Vastaus on nyt lisätty.'));
    }
    
    public static function search() {
        Redirect::to('/search', array('message' => 'Haetaan kysymyksiä.'));
    }

}
