<?php

namespace App\Controllers;

use App\Models\User;

class UserController extends Controller 
{
    public function login()
    {
        return $this->view('products.index');
    }

    public function loginPost()
    {
        $username = htmlspecialchars(trim(strip_tags(stripslashes($_POST['username']))));
        $password = htmlspecialchars(trim(strip_tags(stripslashes($_POST['password']))));
        $user = (new User($this->getDB()))->getByUsername($username);
        // error_log(print_r($user, 1));
        if (password_verify($password, $user[0]->password)) {
            // error_log('mot de passe');die;
            $_SESSION['auth'] = (int) $user[0]->admin;
            // error_log(print_r($_SESSION, 1));
            return header('Location: /gestion/produits');
        } else {
            // error_log('pas de mot de passe');die;
            return header('Location: /gestion/');
        }
    }

    public function logout()
    {
        session_destroy();

        return header('Location: /gestion/');
    }
}

?>