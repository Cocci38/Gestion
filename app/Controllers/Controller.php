<?php

namespace App\Controllers;

use Database\DBConnection;

class Controller {

    protected $db;

    /**
     * Récupérer de la connexion à la bdd passé au constructeur
     */
    public function __construct(DBConnection $db)
    {
        // session_status — Détermine le statut de la session courante
        // PHP_SESSION_NONE si les sessions sont activées, mais qu'aucune n'existe.
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        // error_log(print_r($_SESSION, 1));
        $this->db = $db;
    }

    /**
     * Méthode pour appeler la vue
     * ob_start() — démarre la temporisation de sortie. Tant qu'elle est enclenchée, aucune donnée, hormis les   
     * en-têtes, n'est envoyée au navigateur, mais temporairement mise en tampon.
     * ob_get_clean — Retourne le contenu du tampon de sortie et termine la session de temporisation. Si la temporisation n'est pas activée, alors false sera retourné
     */
    protected function view(string $path, array $params = null)
    {
        ob_start();
        // Pour remplacer les . par des séparateur / ou \
        $path = str_replace('.', DIRECTORY_SEPARATOR, $path);
        require VIEWS . $path . '.php';
        // On stocke le contenu du tampon dans $content
        $content = ob_get_clean();
        // On appelle la view layout.php
        require VIEWS . 'layout.php';
    }

    // Fonction pour récupérer la connexion à la base de données
    protected function getDB() {
        return $this->db;
    }

    protected function isAdmin()
    {
        if (isset($_SESSION['auth']) && $_SESSION['auth'] === 1) {
            // error_log('session réussi');die;
            return true;
        } else {
            // error_log('pas de session');die;
            return header('Location: /gestion');
        }
    }
}
