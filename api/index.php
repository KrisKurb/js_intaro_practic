<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json; charset=UTF-8");

require 'lib/connect.php';
require 'lib/objects/Candidate.php';
require 'lib/objects/Education.php';
require 'lib/methods/methods.php';

$database = new Connect();
$db = $database->Connection();

$method = $_SERVER['REQUEST_METHOD'];

$request = $_GET['request'];
$params = explode('/', $request);

if ($params[0] === 'add')
    $action = $params[0];
else if (
    $params[1] === 'edit' ||
    $params[1] === 'get-candidate' ||
    $params[1] === 'get-education' ||
    $params[1] === 'delete-education' ||
    $params[1] === 'add-education'||
    $params[1] === 'update-status')
    $id = $params[0];

if($method === 'GET') {
//    GET запросы
    if (!isset($id)) {
//        Вывести все резюме
        getResumes($db);
    } else if ($params[1] === 'get-candidate') {
//        Вывести резюме по id
        getCandidateById($db, $id);
    } else if($params[1] === 'get-education') {
//        Вывести образования по id кандидата
        getEducationByIdCandidate($db, $id);
    } else if($params[1] === 'delete-education') {
//        Удалить образование принадлежащее определённому кандидату
        deleteEducationById($db, $id);
    }
} else if ($method === 'POST') {
    //    POST запросы
    if (!isset($action))
        $action = $params[1];

    if ($action === 'add') {
//        Добавление резюме
        addResume($db);
    } else if ($action === 'edit') {
//        Редактирование резюме
        editResume($db, $id);
    } else if ($action === 'add-education') {
//        Добавить образование заданному кандидату если мы находимся в ветке edit
        $data = json_decode(file_get_contents("php://input"));
        addEducation($db, $id, $data->education);
    } else if ($action === 'update-status') {
        updateStatus($db, $id);
    }
}
