<?php
use GuzzleHttp\Psr7\Response;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

require_once 'vendor/autoload.php';
include("model/user.php");
include("config/DBConnection.php");

class UserController
{

    public function index()
    {
        // Render a Twig template with the list of users
        // ...
        $users = User::getAll();
        $loader = new FilesystemLoader("view");
        $twig = new Environment($loader);
        echo $twig->render('index.twig', ['users' => $users]);
    }

    public function show($id)
    {
        $user = User::getById($id);
        // Render a Twig template with the user's details
        // ...
    }

    public function create()
    {
        // Render a Twig template with a form to create a new user
        // ...
    }
    public function store()
    {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $user = new User($name, $email, $password);
        $user->save();
        // Redirect to the user's details page
        // ...
    }

    public function edit($id)
    {
        $user = User::getById($id);
        // Render a Twig template with a form to edit the user's details
        // ...
    }

    public function update($id)
    {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $user = User::getById($id);
        $user->setName($name);
        $user->setEmail($email);
        $user->setPassword($password);
        $user->save();
        // Redirect to the user's details page
        // ...
    }

    public function delete($id)
    {
        $user = User::getById($id);
        $user->delete();
        // Redirect to the list of users
        // ...
    }
}


?>