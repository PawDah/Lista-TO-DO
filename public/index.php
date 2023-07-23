<?php

use MyApp\Controllers\NoteController;
use MyApp\Controllers\HomePageController;
use MyApp\src\Application;

require_once __DIR__.'/../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();


$config =[
    'db' => [
        'dsn' => $_ENV['DB_DSN'],
        'user' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD']
    ]
];


$app=new Application(dirname(__DIR__),$config);

$app->router->get('/',[HomePageController::class,'indexAction']);

$app->router->get('/allNotes',[NoteController::class,'indexAction']);
$app->router->get('/addNote',[NoteController::class,'createNote']);
$app->router->get('/editNote',[NoteController::class,'editNote']);
$app->router->get('/deleteNote',[NoteController::class,'deleteNote']);
$app->router->get('/commentNote',[NoteController::class,'commentNote']);
$app->router->post('/addNote',[NoteController::class,'addNote']);
$app->router->post('/editNote',[NoteController::class,'updateNote']);
$app->router->post('/deleteNote',[NoteController::class,'destroyNote']);
$app->router->post('/commentNote',[NoteController::class,'addComment']);


$app->run();