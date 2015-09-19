<?php

class Question extends BaseModel {

    public $id, $date, $questiontext, $subject, $status, $student_id, $answer_id;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }

    public static function all() {
        $query = DB::connection()->prepare('SELECT* FROM Question');
        $query->execute();
        $rows = $query->fetchAll();
        $questions = array();

        foreach ($rows as $row) {
            $questions[] = new Question(array(
                'id' => $row['id'],
                'date' => $row['date'],
                'questiontext' => $row['questiontext'],
                'subject' => $row['subject'],
                'status' => $row['status'],
                'student_id' => $row['student_id'],
                'answer_id' => $row['answer_id']
            ));
        }

        return $questions;
    }

    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM Question WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $question = new Question(array(
                'id' => $row['id'],
                'date' => $row['date'],
                'questiontext' => $row['questiontext'],
                'subject' => $row['subject'],
                'status' => $row['status'],
                'student_id' => $row['student_id'],
                'answer_id' => $row['answer_id']
            ));

            return $question;
        }

        return null;
    }

}
