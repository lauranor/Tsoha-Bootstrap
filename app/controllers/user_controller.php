<?php

class UserController extends BaseController {

    public static function login() {
        View::make('user/login.html');
    }

    public static function handle_login() {
        $params = $_POST;

        $counsellor = Counsellor::authenticate($params['username'], $params['password']);

        if (!$counsellor) {
            View::make('user/login.html', array('message' => 'Väärä käyttäjätunnus tai salasana!', 'username' => $params['username']));
        } else {
            $_SESSION['counsellor'] = $counsellor->id;

            Redirect::to('/', array('message' => 'Kirjautuneena tunnuksella ' . $counsellor->username));
        }
    }

    public static function logout() {
        $_SESSION['counsellor'] = null;
        Redirect::to('/login', array('message' => 'Olet ulkona!'));
    }

    public static function show_users() {
        $users = Counsellor::all();
        View::make('admin/show_all.html', array('users' => $users));
    }

    public static function edit($id) {
        $counsellor = Counsellor::find($id);

        View::make('admin/edit_user.html', array('counsellor' => $counsellor));
    }

    public static function new_user() {
        View::make('admin/new_user.html');
    }

    public function update($id) {
        $params = $_POST;

        $attributes = array(
            'id' => $id,
            'username' => $params['username'],
            'password' => $params['password'],
            'administrator' => $params['administrator']
        );

        $counsellor = new Counsellor($attributes);
//        $errors = $question->errors();

//        Kint::dump($errors);
//
//        if (count($errors) > 0) {
//            View::make('question/edit.html', array('errors' => $errors, 'attributes' => $attributes));
//        } else {
            $counsellor->update($id);

            Redirect::to('/admin', array('message' => 'Käyttäjää on muokattu onnistuneesti!'));
//        }
    }

    public static function store() {
        $params = $_POST;


        $counsellor = new Counsellor(array(
            'username' => $params['username'],
            'password' => $params['password'],
            'administrator' => $params['administrator']
        ));

        $counsellor->save();

        Redirect::to('/admin', array('message' => 'Uusi käyttäjä lisätty'));
    }
    
    public static function destroy($id){
        $counsellor = new Counsellor(array('id' => $id));

        $counsellor->destroy($id);

        Redirect::to('/admin', array('message' => 'Käyttäjä on nyt poistettu.'));
    }

}
