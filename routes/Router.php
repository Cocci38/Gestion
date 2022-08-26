<?php
namespace Router;

use App\Exceptions\NotFoundException;

// Cette classe permet d'ajouter des URLs à capturer mais aussi le code à executer

class Router {

    // Contiendra l'URL sur laquelle on souhaite se rendre
    private $url; 
    // Contiendra la liste des routes
    private $routes = [];

    public function __construct($url) {
        // trim pour enlever les slash en début et fin d'url
        $this->url = trim($url, '/');
    }

    // Méthodes correspondantes aux différentes méthodes HTTP 
    // Méthode get() 
    public function get(string $path, string $action)
    {
        $this->routes['GET'][] = new Route($path, $action);
    }

    public function post(string $path, string $action)
    {
        $this->routes['POST'][] = new Route($path, $action);
    }

    /**
     * Méthode pour parcourir les différentes routes enregistrées et vérifier s'il y a correspondance avec l'URL qui est passée au constructeur grâce à la fonction matches()
     * Si aucune route ne correspond à l'URL ou la méthode alors on renvoie une Exception pour afficher les erreurs
     */
    public function run () {
        foreach ($this->routes[$_SERVER['REQUEST_METHOD']] as $route) {
            if ($route->matches($this->url)) {
                return $route->execute();
            }
        }
        throw new NotFoundException("La page demandée est introuvable :(");
    }
}
