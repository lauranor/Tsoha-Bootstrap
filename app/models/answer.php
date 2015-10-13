<?php

class Answer extends BaseModel {

    public $id, $answertext, $question_id;

    public function __construct($attributes) {
        parent::__construct($attributes);
        //$this->validators = array('validate_title');
    }

    public function save() {
        $query = DB::connection()->prepare('INSERT INTO Answer (answertext, question_id) VALUES (:answertext, :question_id) RETURNING id');

        $query->execute(array('answertext' => $this->answertext, 'question_id' => $this->question_id));

        $row = $query->fetch();
        $this->id = $row['id'];
    }

    public function find($id) {
        $query = DB::connection() ->prepare('SELECT * FROM Answer WHERE question_id = :id');
        $query->execute(array('question_id' => $id));
        $row = $query->fetch();
        
        if ($row) {
            $answer = new Answer(array(
                'id' => $row['id'],
                'question_id' => $row['question_id'],
                'answertext' => $row['answertext']
            ));

            return $answer;
        }

        return null;
    }
    
    

}


