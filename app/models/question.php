<?php

class Question extends BaseModel {
    
    //id, added, title, questiontext, category_id, nametext, (id in (select question_id from answer)) as status, LEFT JOIN Category ON category_id = category.id

    public $id, $added, $questiontext, $title, $category_id, $nametext, $status;

    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validate_title');
    }

    public static function all() {
        $query = DB::connection()->prepare('SELECT question.id, added, title, questiontext, category_name as category_id, nametext, (question.id in (select question_id from answer)) as status FROM Question LEFT JOIN Category ON category_id = category.id ORDER BY question.id DESC');
        $query->execute(); 
        $rows = $query->fetchAll();
        $questions = array();

        foreach ($rows as $row) {
            $questions[] = new Question(array(
                'id' => $row['id'],
                'added' => $row['added'],
                'title' => $row['title'],
                'questiontext' => $row['questiontext'],
                'nametext' => $row['nametext'],
                'category_id' => $row['category_id'],
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
                'nametext' => $row['nametext'],
                'category_id' => $row['category_id'],
                'status' => $row['status']
            ));

            return $question;
        }

        return null;
    }
    
    public function save() {
        $query = DB::connection()->prepare('INSERT INTO Question (questiontext, title, nametext, category_id) VALUES (:questiontext, :title, :nametext, :category_id) RETURNING id');
        
        $query->execute(array('questiontext' => $this->questiontext, 'title' => $this->title, 'nametext'=> $this->nametext,'category_id' => $this->category_id));
        
        $row = $query->fetch();
        $this->id = $row['id'];
    }
    
    
    public function update($id) {
        $query = DB::connection()->prepare('UPDATE Question SET questiontext = :questiontext, title = :title WHERE id = :id');
        
        $query->execute(array('questiontext' => $this->questiontext, 'title' => $this->title, 'id' => $id));
        
    }
    
    public function destroy($id) {
        $query = DB::connection()->prepare('DELETE FROM Question WHERE id = :id');
        
        $query->execute(array('id' => $id));
        
    }
    
    public function validate_title() {
        $errors = array();
        
        if($this->title == '' || $this->title == null) {
            $errors[] = 'Otsikko ei saa olla tyhjä!';
        }
        if(strlen($this->title) < 5) {
            $errors[] = 'Otsikon pituus tulee olla vähintään 5 merkkiä.';
        }
        
        return $errors;
    }
    
    public function answered() {
        $query = DB::connection()->prepare('UPDATE Question SET status = :status WHERE id = :id');
        
        $query->execute(array('status' => 'TRUE', 'id' => $this->id));
        
    }
    
    public function find_by_category($id) {
        $query = DB::connection()->prepare('SELECT * FROM Question WHERE category_id = :id');
        $query->execute(array('category_id' => $id)); 
        $rows = $query->fetchAll();
        $questions = array();

        foreach ($rows as $row) {
            $questions[] = new Question(array(
                'id' => $row['id'],
                'added' => $row['added'],
                'title' => $row['title'],
                'questiontext' => $row['questiontext'],
                'nametext' => $row['nametext'],
                'category_id' => $row['category_id'],
                'status' => $row['status']
            ));
        }

        return $questions;
        
    }
    
    
    

}
