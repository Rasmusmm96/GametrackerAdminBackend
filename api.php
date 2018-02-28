<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Slim\App;

require 'vendor/autoload.php';
require_once 'DLL/gamemanager.php';
require_once 'DLL/adminmanager.php';
require_once 'BE/game.php';

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Access-Control-Allow-Headers: Authorization, Token, Content-Type');

$configuration = [
    'settings' => [
        'displayErrorDetails' => true,
    ],
];

$c = new \Slim\Container($configuration);
$app = new App($c);
$gamemanager = new GameManager();
$adminmanager = new AdminManager();

$app->get("/", function (Request $request, Response $response) {
    return $response->withStatus(200)->write(file_get_contents("docs.html"));
});

$app->post('/games/add', function (Request $request, Response $response, array $args) {
    global $gamemanager;


    $token = $request->getHeaderLine('Token');
    $game = new Game(
        null,
        $_POST['title'],
        $_POST['developer'],
        $_POST['publisher'],
        $_POST['release_date'],
        $_POST['twitter_handle'],
        $_POST['youtube_id']
        );

    $result = $gamemanager->addGame($game, $token);

    if ($result) {
        return $response->withStatus(200);
    } else {
        return $response->withStatus(400);
    }
});

$app->post('/games/update', function (Request $request, Response $response, array $args) {
    global $gamemanager;

    $token = $request->getHeaderLine('Token');
    $game = new Game(
        $_POST['id'],
        $_POST['title'],
        $_POST['developer'],
        $_POST['publisher'],
        $_POST['release_date'],
        $_POST['twitter_handle'],
        $_POST['youtube_id']
    );


    $result = $gamemanager->updateGame($game, $token);

    if ($result) {
        return $response->withStatus(200);
    } else {
        return $response->withStatus(400);
    }
});

$app->delete('/games/delete/{id}', function (Request $request, Response $response, array $args) {
    global $gamemanager;

    $token = $request->getHeaderLine('Token');
    $id = $args['id'];

    $result = $gamemanager->deleteGame($id, $token);

    if ($result) {
        return $response->withStatus(200);
    } else {
        return $response->withStatus(400);
    }
});

$app->post('/admin/add', function (Request $request, Response $response, array $args) {
    global $adminmanager;

    $token = $request->getHeaderLine('Token');
    $username = $_POST['username'];
    $password = $_POST['password'];

    $result = $adminmanager->addAdmin($username, $password, $token);

    if ($result) {
        return $response->withStatus(200);
    } else {
        return $response->withStatus(400);
    }
});

$app->get('/admin/login', function (Request $request, Response $response, array $args) {
    global $adminmanager;

    $username = $_SERVER['PHP_AUTH_USER'];
    $password = $_SERVER['PHP_AUTH_PW'];

    $result = $adminmanager->login($username, $password);

    if ($result) {
        return $response->withStatus(200)->withHeader('Content-Type', 'application/json')->write(json_encode($result));
    } else {
        return $response->withStatus(400);
    }
});

$app->run();
