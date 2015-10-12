<?php

class Category extends BaseModel {

    public $id, $category_name;

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
                'category_name' => $row['category_name']
            ));
        }

        return $categories;
    }
    
    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM Category WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $category = new Subject(array(
                'id' => $row['id'],
                'category_name' => $row['category_name']
            ));

            return $category;
        }

        return null;
    }

}

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

