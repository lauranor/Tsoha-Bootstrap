<?php

class Counsellor extends BaseModel{
    
    public $id, $nametext, $password, $administrator;
    
    public function __construct($attributes) {
        parent::__construct($attributes);
    }
    
    public static function all(){
        $query = DB::connection()->prepare('SELECT * FROM Counsellor');
        $query->execute();
        $rows = $query->fetchAll();
        $counsellors = array();

        foreach ($rows as $row) {
            $counsellors[] = new Counsellor(array(
                'id' => $row['id'],
                'nametext' => $row['nametext'],
                'password' => $row['password'],
                'administrator' => $row['administrator']
            ));
        }

        return $counsellors;
    }
    
    
    public static function find() {
        $query = DB::connection()->prepare('SELECT * FROM Counsellor WHERE id= :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();
        
        if ($row) {
            $counsellor = new Counsellor(array(
                'id' => $row['id'],
                'nametext' => $row['nametext'],
                'password' => $row['password'],
                'administrator' => $row['administrator']
            ));
            
            return $counsellor;
        }
        
        return null;
    }
    
}

