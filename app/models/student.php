<?php

class Student extends BaseModel {

    public $id, $nametext, $email;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }

    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM Student');
        $query->execute();
        $rows = $query->fetchAll();
        $students = array();

        foreach ($rows as $row) {
            $students[] = new Student(array(
                'id' => $row['id'],
                'nametext' => $row['nametext'],
                'email' => $row['email']
            ));
        }

        return $students;
    }

    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM Student WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $student = new Student(array(
                'id' => $row['id'],
                'nametext' => $row['nametext'],
                'email' => $row['email']
            ));

            return $student;
        }

        return null;
    }

}

