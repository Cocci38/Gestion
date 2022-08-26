<?php

namespace App\Models;

use PDO;
use PDOException;
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

    public function create(Model $data, ?array $relations = null)
    {
        $keys=[];
        $inter=[];
        $values=[];

        foreach ($data as $key => $value) {
            if($value != null && $key != 'table' && $key != 'db'){
            $keys[ ]=$key;
            $inter[]="?";
            $values[]=$value;
            }
        }
        $colonne=implode(",",$keys);
        $stringInter=implode(",",$inter);

        $select = $this->db->getPDO()->prepare("INSERT INTO {$this->table} ($colonne)
        VALUES($stringInter)");
        $select->execute($values);

        // try {
        //     $stmt = $this->db->getPDO()->prepare("INSERT INTO $this->table (status, description, date, location, firstname, lastname, email, users_id) VALUES(:status, :description, :date, :location, :firstname, :lastname, :email, :users_id)");
        //     $stmt->bindParam("status", $status, PDO::PARAM_INT);
        //     $stmt->bindParam("description", $description, PDO::PARAM_STR);
        //     $stmt->bindParam("date", $date, PDO::PARAM_STR);
        //     $stmt->bindParam("location", $location, PDO::PARAM_STR);
        //     $stmt->bindParam("firstname", $firstname, PDO::PARAM_STR);
        //     $stmt->bindParam("lastname", $lastname, PDO::PARAM_STR);
        //     $stmt->bindParam("email", $email, PDO::PARAM_STR);
        //     $stmt->bindParam("users_id", $users_id, PDO::PARAM_INT);
        //     $stmt->execute();
        // } catch (PDOException $exception) {
        //     echo "Erreur de connexion : " . $exception->getMessage();
        // }
    }
}
