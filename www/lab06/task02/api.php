<?php
session_start();

include_once("db.php");
include_once("classes/UserService.php");
include_once("classes/NoteService.php");

use classes\UserService;
use classes\NoteService;

$allowedActions = [
    'register','login','update','delete','logout','me',
    'getNotes','createNote','updateNote','deleteNote', 'getNote'
];

$pdo = dbConnect();
$userService = new UserService($pdo);
$noteService = new NoteService($pdo);

if (isset($_GET['action']) && in_array($_GET['action'], $allowedActions)) {

    $data = json_decode(file_get_contents("php://input"), true);
    $userId = $_SESSION['user_id'] ?? null;

    switch ($_GET['action']) {

        case 'me':
            if($userId){
                echo json_encode(['id' => $userId]);
            } else {
                echo json_encode([]);
            }
            break;

        case 'register':
            $user = $userService->register($data['name'], $data['email'], $data['password']);
            if(isset($user['id'])){
                $_SESSION['user_id'] = $user['id'];
            }
            echo json_encode($user);
            break;

        case 'login':
            $user = $userService->login($data['email'], $data['password']);
            if(isset($user['id'])){
                $_SESSION['user_id'] = $user['id'];
            }
            echo json_encode($user);
            break;

        case 'update':
            echo json_encode($userService->update($data['id'], $data['name'], $data['email'], $data['password']));
            break;

        case 'delete':
            echo json_encode($userService->delete($data['email'], $data['password']));
            break;

        case 'logout':
            session_destroy();
            echo json_encode(['success' => true]);
            break;

        case 'getNotes':
            if(!$userId){
                echo json_encode([]);
                break;
            }

            echo json_encode($noteService->getAll($userId));
            break;

        case 'getNote':
            if(!$userId){
                echo json_encode([]);
                break;
            }

            $noteId = $_GET['id'] ?? null;
            echo json_encode($noteService->getById($noteId, $userId));
            break;

        case 'createNote':
            echo json_encode($noteService->create(
                $userId,
                $data['title'],
                $data['content']
            ));
            break;

        case 'updateNote':
            echo json_encode($noteService->update(
                $data['id'],
                $userId,
                $data['title'],
                $data['content']
            ));
            break;

        case 'deleteNote':
            echo json_encode($noteService->delete(
                $data['id'],
                $userId
            ));
            break;
    }

    exit;

} else {
    echo json_encode(["error" => "Incorrect action"]);
}