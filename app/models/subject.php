<?php

class Subject extends BaseModel {

    public $id, $text;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }

    public static function all() {
        $query = DB::connection()->prepare('SELECT* FROM Category');
        $query->execute();
        $rows = $query->fetchAll();
        $categories = array();

        foreach ($rows as $row) {
            $categories[] = new Category(array(
                'id' => $row['id'],
                'cateory' => $row['category']
            ));
        }

        return $categories;
    }

    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM Question WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $subject = new Subject(array(
                'id' => $row['id'],
                'subject' => $row['subject']
            ));

            return $subject;
        }

        return null;
    }

}

