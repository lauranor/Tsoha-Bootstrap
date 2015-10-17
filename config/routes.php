<?php

$routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
});

//sisäänkirjautumissivu
$routes->get('/login', function() {
    UserController::login();
});

$routes->post('/login', function() {
    UserController::handle_login();
});

//uloskirjautuminen
$routes->get('/logout', function() {
    UserController::logout();
});

//kysymyksen sivu
//$routes->get('/esittely', function() {
//    HelloWorldController::esittely();
//});
//uuden kysymisivu
$routes->get('/new', function() {
    QuestionController::ask();
});

$routes->get('/edit/:id', function($id) {
    QuestionController::edit($id);
});

$routes->post('/edit/:id', function($id) {
    QuestionController::update($id);
});

//kysymysten listaussivu / etusivu
$routes->get('/', function() {
    QuestionController::index();
});

$routes->post('/question', function() {
    QuestionController::store();
});


$routes->get('/question/:id', function($id) {
    QuestionController::show($id);
});

//kysymyksen muokkaaminen
//$routes->get('/question/:id/edit', function($id) {
//    QuestionController::edit($id);
//});

//$routes->post('/question/:id/edit', function($id) {
//    QuestionController::update($id);
//});

//kysymyksen poistaminen
$routes->post('/question/:id/destroy', function($id) {
    QuestionController::destroy($id);
});

//vastauslomake
$routes->get('/answer/:id', function($id) {
    AnswerController::answer($id);
});

$routes->post('/answer', function() {
    AnswerController::store();
});

$routes->get('/search', function() {
    QuestionController::search();
});

$routes->post('/search/:id', function($id) {
    QuestionController::search_by_category($id);
});

$routes->get('/admin', function() {
    UserController::show_users();
});

$routes->get('/user/:id', function($id){
    UserController::show($id);
});

$routes->get('/edit_user/:id', function($id){
    UserController::edit($id);
});

$routes->post('/edit_user/:id', function($id){
    UserController::update($id);
});

$routes->get('new_user', function(){
    UserController::new_user();
});
