<?php

namespace App\Models;

use PDO;
use PDOException;
use Database\DBConnection;

class Model
{

    protected $db;
    protected $table;
    protected $id;

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

    public function readById(int $id)
    {
        // print_r($_GET);
        // Je transforme l'url ($_GET) en chaine de caractère
        $url = implode($_GET);
        // print_r($url);
        // Avec explode(), je retourne un tableau de chaine de caractères en plusieurs morceaux selon le /
        // Avec en(), je récupère le dernier élément du tableau.
        // @$end = end(explode('/', $url));
        $url = explode('/', $url);
        $end = end($url);
        $id = htmlspecialchars(strip_tags(trim(stripslashes($end))));
        // echo "<pre>",print_r($end, 1),"</pre>";
        $select = $this->db->getPDO()->prepare("SELECT * FROM $this->table WHERE $this->id = ?");
        $select->setFetchMode(PDO::FETCH_CLASS, get_class($this), [$this->db]);
        $select->execute([$id]);
        return $select->fetch();
    }

    private function getteType($value)
    {
        $type = null;
        switch (gettype($value)) {
            case 'string':
                return PDO::PARAM_STR;
                break;
            case 'integer':
                return PDO::PARAM_INT;
                break;
        }
        // return $type;
    }

    public function create(Model $data, ?array $relations = null)
    {
        try {
            $colonne = '';
            $stringInter = '';
            foreach ($this->donnee as $key => $value) {
                // error_log(print_r($key, 1));
                // error_log(print_r($value, 1));
                // Si les value ne sont pas null et que les key est différent de table et de db
                if ($value !== null && $key != 'table' && $key != 'db') {
                    // error_log(print_r($key, 1));
                    // error_log(print_r($value, 1));
                    $keys[] = $key;
                    $inter[] = ":" . $key;
                    // $values[] = $value;
                }
            }
            $colonne = implode(",", $keys);
            $stringInter = implode(",", $inter);
            // error_log(print_r($colonne, 1));
            // error_log(print_r($stringInter, 1));
            $select = $this->db->getPDO()->prepare("INSERT INTO {$this->table} ($colonne) VALUES ($stringInter)");
            foreach ($this->donnee as $key => $value) {
                // error_log(print_r($key, 1));
                // error_log(print_r($this->getteType($value), 1));
                $select->bindValue(':' . $key, $value, $this->getteType($value));
                // error_log($key, $value, $this->getteType($value));
            }
            $select->execute();
            // if ($select->rowCount() > 0) {
            //     error_log('probleme');
            // } else {
            //     error_log('pas de problème');
            // }
        } catch (PDOException $exception) {
            echo "Erreur de connexion : " . $exception->getMessage();
        }
    }

    public function update(int $id, Model $data, ?array $relations = null)
    {
        try {
            $url = implode($_GET);
            // Avec explode(), je retourne un tableau de chaine de caractères en plusieurs morceaux selon le /
            // Avec en(), je récupère le dernier élément du tableau.
            // @$end = end(explode('/', $url));
            $url = explode('/', $url);
            $end = end($url);
            $id = htmlspecialchars(strip_tags(trim(stripslashes($end))));
            // error_log($id);
            $keys = [];
            foreach ($this->donnee as $key => $value) {
                if ($value != null && $key != 'table' && $key != 'db') {
                    // error_log(print_r($this->donnee, 1));
                    // error_log(print_r($key, 1));
                    // error_log(print_r($value, 1));
                    $keys[] = $key . ' = "' . $value .'"';
                    // error_log(print_r($keys, 1));
                }
            }
            // error_log($value);
            // die;
            // error_log(print_r($values));
            $keys = implode(", ", $keys);
            // error_log(print_r($keys));
            // error_log(print_r($tab));
            $update = $this->db->getPDO()->prepare("UPDATE {$this->table} SET $keys WHERE {$this->id} = $id");
            foreach ($this->donnee as $key => $value) {
                // error_log(print_r($this->getteType($value), 1));
                $update->bindValue(':' . $key, $value, $this->getteType($value));
            }
            error_log(print_r($update));
            $update->execute();
        } catch (PDOException $exception) {
            echo "Erreur de connexion : " . $exception->getMessage();
        }
    }

    public function delete(int $id)
    {
        try {
            // Je transforme l'url ($_GET) en chaine de caractère
            $url = implode($_GET);
            // Avec explode(), je retourne un tableau de chaine de caractères en plusieurs morceaux selon le /
            // Avec en(), je récupère le dernier élément du tableau.
            // @$end = end(explode('/', $url));
            $url = explode('/', $url);
            $end = end($url);
            $id = htmlspecialchars(strip_tags(trim(stripslashes($end))));
            $delete = $this->db->getPDO()->prepare("DELETE  FROM $this->table WHERE $this->id = ?");
            $delete->execute([$id]);
            $supp = $delete->fetch();
        } catch (PDOException $exception) {
            echo "Erreur de connexion : " . $exception->getMessage();
        }
    }
}
