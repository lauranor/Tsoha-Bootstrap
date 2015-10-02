<?php

//  $routes->get('/', function() {
//    HelloWorldController::index();
//  });

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
$routes->get('/esittely', function() {
    HelloWorldController::esittely();
});

//uuden kysymisivu
$routes->get('/new', function() {
    QuestionController::ask();
});

$routes->get('/edit/:id', function($id) {
    QuestionController::edit($id);
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
$routes->get('/question/:id/edit', function($id) {
    QuestionController::edit($id);
});

$routes->post('/question/:id/edit', function($id) {
    QuestionController::update($id);
});

//kysymyksen poistaminen
$routes->post('/question/:id/destroy', function($id) {
    QuestionController::destroy($id);
});

