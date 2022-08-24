<?php

namespace Router;

/**
 * La classe Route représente une route avec plusieurs méthodes pour permettre de savoir si la route valide l'URL
 */

class Route {

    public $path;
    public $action;
    public $matches;

    public function __construct($path, $action)
    {
        // On retire les / inutiles
        $this->path = trim($path, '/');
        $this->action = $action;
    }

    /**
     * Fonction pour permettre de capturer l'URL avec les paramètres
     * par exemple : get('posts/:id')
     */
    public function matches($url) {
        // On cherche à remplacer (\w est un raccourci)
        $path = preg_replace('#:([\w]+)#', '([^/]+)', $this->path);
        // On veut passer toute la variable
        $pathToMatch = "#^$path$#";

        if (preg_match($pathToMatch, $url, $matches)){
            // On sauvegarde les paramètres dans l'instance pour plus tard
            $this->matches = $matches;
            return true;
        }else{
            return false;
        }
    }

    // public function execute()
    // {
    //     $params = explode('@', $this->action); // @ est le délimiteur de notre action
    //     $controller = new $params[0](new DBConnection(DB_NAME, DB_HOST, DB_USER, DB_PWD)); // La 1ère clé du tableau params
    //     $method = $params[1]; // La 2ème clé du tableau params

    //     return isset($this->matches[1]) ? $controller->$method($this->matches[1]) : $controller->$method();
    // }

    public function execute()
    {
        $params = explode('@', $this->action); // @ est le délimiteur de notre action
        $controller = new $params[0](); // La 1ère clé du tableau params
        $method = $params[1]; // La 2ème clé du tableau params

        return isset($this->matches[1]) ? $controller->$method($this->matches[1]) : $controller->$method();
    }


}
?>