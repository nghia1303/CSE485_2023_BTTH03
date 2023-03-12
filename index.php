<?php
require_once 'vendor/autoload.php';
include('controller/UserController.php');

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Psr\Http\Message\ServerRequestInterface;

$routes = new RouteCollection();

// List all users
$routes->add(
    'user.index',
    new Route(
        '/',
        array(
            '_controller' => array(new UserController(), 'index')
        )
    )
);

// $route = new Route(
//     '/external',
//     array(
//         '_controller' => array(new ExternalController(), 'index')
//     )
// );

// Show user details
$routes->add(
    'user.show',
    new Route(
        '/users/{id}',
        array(
            '_controller' => 'UserController::show',
        )
    )
);

// Create a new user (show form)
$routes->add(
    'user.create',
    new Route(
        '/users/create',
        array(
            '_controller' => 'UserController::create',
        )
    )
);

// Store a new user (handle form submission)
$routes->add('user.store', new Route('/users', array(
    '_controller' => 'UserController::store',
), array(), array(), '', array(), array('POST')));

// Edit user details (show form)
$routes->add(
    'user.edit',
    new Route(
        '/users/{id}/edit',
        array(
            '_controller' => 'UserController::edit',
        )
    )
);

// Update user details (handle form submission)
$routes->add('user.update', new Route('/users/{id}', array(
    '_controller' => 'UserController::update',
), array(), array(), '', array(), array('PUT', 'PATCH')));

// Delete user
$routes->add('user.delete', new Route('/users/{id}', array(
    '_controller' => 'UserController::delete',
), array(), array(), '', array(), array('DELETE')));

// Initialize the routing context
$requestContext = new RequestContext();
$request = Request::createFromGlobals();
$requestContext->fromRequest($request);

// Match the current request to a route
$matcher = new UrlMatcher($routes, $requestContext);
$parameters = $matcher->match($request->getPathInfo());

// Call the appropriate controller method with the matched parameters
$controller = $parameters['_controller'];


$response = call_user_func_array($parameters['_controller'], array($parameters));

// Send the response to the browser
