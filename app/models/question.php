<?php

class Question extends BaseModel {

    public $id, $date, $questiontext, $title, $subject, $status, $student_id;

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
                'added' => $row['added'],
                'title' => $row['title'],
                'questiontext' => $row['questiontext'],
//                'subject_id' => $row['subject_id'],
//                'email' => $row['email'],
                'status' => $row['status']
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
                'added' => $row['added'],
                'title' => $row['title'],
                'questiontext' => $row['questiontext'],
                //'subject' => $row['subject'],
                //'student_id' => $row['student_id'],
                'status' => $row['status']
            ));

            return $question;
        }

        return null;
    }
    
    public function save() {
        $query = DB::connection()->prepare('INSERT INTO Question (questiontext, title) VALUES (:questiontext, :title) RETURNING id');
        
        $query->execute(array('questiontext' => $this->questiontext, 'title' => $this->title));
        
        $row = $query->fetch();
        $this->id = $row['id'];
    }
    
    
    public function update() {
        $query = DB::connection()->prepare('UPDATE Question (questiontext, title) VALUES (:questiontext, :title)');
        
        $query->execute(array('questiontext' => $this->questiontext, 'title' => $this->title));
        
        $row = $query->fetch();
        $this->id = $row['id'];
    }
    
    public function destroy($id) {
        $query = DB::connection()->prepare('DELETE FROM Question WHERE id = :id');
        
        $query->execute();
        $row = $query->fetch();
        
    }
    

}
