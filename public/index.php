<?php

use Router\Router;
use App\Exceptions\NotFoundException;

require '../vendor/autoload.php';

require_once 'config.php';

$router = new Router( $_GET['url']);

// On appelle la fonction index et show dans le bloc BlogController
$router->get('/', 'App\Controllers\ManagementController@index'); // Un chemin '/' et une action ManagementController@index' (le controller @ la méthode)
$router->get('/produits', 'App\Controllers\ManagementController@product'); // Dans l'url on écrit produits
$router->get('/produits/:id', 'App\Controllers\ManagementController@productId'); // Dans l'url on écrit produits/id
// Route pour afficher le formulaire
// $router->get('/ajout', 'App\Controllers\ManagementController@form'); // Dans l'url on écrit form
// Route pour renvoyer le formulaire
$router->get('/ajout', 'App\Controllers\ManagementController@create');
$router->get('/update/:id', 'App\Controllers\ManagementController@updateProduct');
// Route pour traiter les données du formulaire
$router->post('/ajout', 'App\Controllers\ManagementController@createProduct'); // Dans l'url on écrit form
$router->post('/update/:id', 'App\Controllers\ManagementController@update');
$router->post('/delete/:id', 'App\Controllers\ManagementController@delete');
/**
 * On tente d'executer cette fonction, si cette fonction relève une erreur (ici aucune route ne match avec l'url)
 * On va pouvoir ratrapper notre exception qui est de classe Exception et lui passer  le message indiqué dans getMessage()
 */
try{
    $router->run(); 
    // On l'attrape avec catch si elle nous retourne une exception
} catch (NotFoundException $e) {
    // $e comme pour erreur  // $e->getMessage() => Pour afficher notre message
    echo $e->getMessage();
}

?>