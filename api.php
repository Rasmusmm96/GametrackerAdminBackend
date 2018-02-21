<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Slim\App;

require 'vendor/autoload.php';
require_once 'DLL/gamemanager.php';
require_once 'DLL/adminmanager.php';

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

$app->post('/games/add/{title}/{developer}/{publisher}/{release_date}', function (Request $request, Response $response, array $args) {
    global $gamemanager;

    $title = $args['title'];
    $developer = $args['developer'];
    $publisher = $args['publisher'];
    $releasedate = $args['release_date'];

    $result = $gamemanager->addGame($title, $developer, $publisher, $releasedate);

    if ($result) {
        return $response->withStatus(200);
    } else {
        return $response->withStatus(400);
    }
});

$app->put('/games/update/{id}/{title}/{developer}/{publisher}/{release_date}', function (Request $request, Response $response, array $args) {
    global $gamemanager;

    $id = $args['id'];
    $title = $args['title'];
    $developer = $args['developer'];
    $publisher = $args['publisher'];
    $releasedate = $args['release_date'];

    $result = $gamemanager->updateGame($id, $title, $developer, $publisher, $releasedate);

    if ($result) {
        return $response->withStatus(200);
    } else {
        return $response->withStatus(400);
    }
});

$app->delete('/games/delete/{id}', function (Request $request, Response $response, array $args) {
    global $gamemanager;

    $id = $args['id'];

    $result = $gamemanager->deleteGame($id);

    if ($result) {
        return $response->withStatus(200);
    } else {
        return $response->withStatus(400);
    }
});

$app->post('/admin/add', function (Request $request, Response $response, array $args) {
    global $adminmanager;

    $username = $_SERVER['PHP_AUTH_USER'];
    $password = $_SERVER['PHP_AUTH_PW'];

    $result = $adminmanager->addAdmin($username, $password);

    if ($result) {
        return $response->withStatus(200);
    } else {
        return $response->withStatus(400);
    }
});

$app->post('/admin/login', function (Request $request, Response $response, array $args) {
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
