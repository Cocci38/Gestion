<?php

use Router\Router;
use App\Exceptions\NotFoundException;

require '../vendor/autoload.php';

// Constante qui est un chemin qui pointe vers le dossier des vues (dirname(__DIR__) renvoie vers le dossier)
// dirname — Renvoie le chemin du dossier parent
define ('VIEWS' , dirname(__DIR__) . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR);
// Contante qui envoie vers nos dossiers de script (dirname($_SERVER['SCRIPT_NAME']) pour avoir un bon chemin vers les scripts)
define('SCRIPTS' , dirname($_SERVER['SCRIPT_NAME']). DIRECTORY_SEPARATOR);
define('DB_NAME', 'magasin');
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PWD', '');

$router = new Router( $_GET['url']);

// On appelle la fonction index et show dans le bloc BlogController
$router->get('/', 'App\Controllers\ManagementController@index'); // Un chemin '/' et une action ManagementController@index' (le controller @ la méthode)
$router->get('/produits', 'App\Controllers\ManagementController@product'); // Dans l'url on écrit produits
$router->get('/produits/:id', 'App\Controllers\ManagementController@productId'); // Dans l'url on écrit produits/id
// Route pour afficher le formulaire
// $router->get('/ajout', 'App\Controllers\ManagementController@form'); // Dans l'url on écrit form
// Route pour renvoyer le formulaire
$router->get('/ajout', 'App\Controllers\ManagementController@create');
// Route pour traiter les données du formulaire
$router->post('/ajout', 'App\Controllers\ManagementController@createProduct'); // Dans l'url on écrit form
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