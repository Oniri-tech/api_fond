<?php
declare(strict_types=1);

use App\Application\Actions\User\ListUsersAction;
use App\Application\Actions\User\ViewUserAction;
use App\DAO\DAO_recipe;
use App\DAO\DAO_ingredient;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return function (App $app) {
    $app->options('/{routes:.*}', function (Request $request, Response $response) {
        // CORS Pre-Flight OPTIONS Request Handler
        return $response;
    });
    $app->get('/', function (Request $request, Response $response){
        $response->getBody()->write('Bienvenue sur l\'index');
        return $response;
    });

    /**
     * Routes pour les recettes
     */
    $app->get('/recipes', function (Request $request, Response $response) {
        $dao = new DAO_recipe;
        $response->getBody()->write(json_encode($dao->getAll()));
        return $response;
    });
    $app->get('/recipeById/{id}', function (Request $request, Response $response, $args) {
        $dao = new DAO_recipe;
        $id =intval($args['id']);
        $response->getBody()->write(json_encode($dao->getById($id)));
        return $response;
    });
    $app->get('/recipeByName/{name}', function (Request $request, Response $response, $args) {
        $dao = new DAO_recipe;
        $name =$args['name'];
        $response->getBody()->write(json_encode($dao->getByName($name)));
        return $response;
    });

    /**
     * Routes pour les ingrédients
     */
    $app->post('/ingredient', function (Request $request, Response $response){
        $dao = new DAO_ingredient;
        $response->getBody()->write($dao->addIngredient($_POST['name']));
        return $response;
    });
    $app->get('/ingredients', function (Request $request, Response $response) {
        $dao = new DAO_ingredient;
        $response->getBody()->write(json_encode($dao->getAll()));
        return $response;
    });
    $app->get('/ingredientById/{id}', function (Request $request, Response $response, $args) {
        $dao = new DAO_ingredient;
        $id =intval($args['id']);
        $response->getBody()->write(json_encode($dao->getById($id)));
        return $response;
    });
    $app->get('/ingredientByName/{name}', function (Request $request, Response $response, $args) {
        $dao = new DAO_ingredient;
        $name =$args['name'];
        $response->getBody()->write(json_encode($dao->getByName($name)));
        return $response;
    });

    $app->group('/user', function (Group $group) {
        $group->get('', ListUsersAction::class);
        $group->get('/{id}', ViewUserAction::class);
    });

};
