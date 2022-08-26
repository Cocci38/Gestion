<?php

namespace App\Models;

use PDO;
use Database\DBConnection;

class Model
{

    protected $db;
    protected $table;

    /**
     * Récupérer de la connexion à la bdd passé au constructeur
     */
    public function __construct(DBConnection $db)
    {
        $this->db = $db;
    }

    /**
     * Méthode pour lire les données qui arrivent de la base de données
     * PDO::FETCH_CLASS: retourne une nouvelle instance de la classe demandée, 
     * liant les colonnes du jeu de résultats aux noms des propriétés de la classe et en appelant le constructeur par la suite
     * get_class — Retourne le nom de la classe d'un objet
     */
    public function read()
    {
        $select = $this->db->getPDO()->prepare("SELECT * FROM " . $this->table);
        $select->setFetchMode(PDO::FETCH_CLASS, get_class($this), [$this->db]);
        $select->execute();
        return $select->fetchAll();
    }

    public function readById(int $id_produit)
    {
        // Je transforme l'url ($_GET) en chaine de caractère
        $url = implode($_GET);
        // Avec explode(), je retourne un tableau de chaine de caractères en plusieurs morceaux selon le /
        // Avec en(), je récupère le dernier élément du tableau.
        @$end = end(explode('/', $url));
        $id_produit = htmlspecialchars(strip_tags(trim(stripslashes($end))));
        // echo "<pre>",print_r($end, 1),"</pre>";
        $select = $this->db->getPDO()->prepare("SELECT * FROM $this->table WHERE id_produit = $id_produit");
        $select->setFetchMode(PDO::FETCH_CLASS, get_class($this), [$this->db]);
        $select->execute();
        return $select->fetch();
    }
}
