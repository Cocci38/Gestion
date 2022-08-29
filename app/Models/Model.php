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

    public function create(Product $data, ?array $relations = null)
    {

        error_log(print_r($data, 1));
        try {
            $colonne = '';
            $stringInter = '';
            foreach ($data as $key => $value) {
                // Si les value ne sont pas null et que les key est différent de table et de db
                if (gettype($value) == 'integer' || gettype($value) == 'string') {
                    if ($value !== null && $key != 'table' && $key != 'db') {
                        $keys[] = $key;
                        $inter[] = ":" . $key;
                        // $values[] = $value;
                    }
                }
            }

            $colonne = implode(",", $keys);
            $stringInter = implode(",", $inter);

            // error_log(print_r($colonne, 1));
            // error_log(print_r($stringInter, 1));

            $select = $this->db->getPDO()->prepare("INSERT INTO {$this->table} ($colonne) VALUES ($stringInter)");
            // echo "<pre>", print_r($keys, 1), "</pre>";
            //             die;

            foreach ($data as $key => $value) {
                if ($value !== null && $key != 'table' && $key != 'db') {
                    // error_log('valeur', $value);
                    // $keys = $data->__set("$key", $value);
                    error_log(print_r($data->__get($keys), 1));
                    // $bp = $data->__get($keys);
                    error_log(print_r($data->__set($key, $value), 1));
                    if (gettype($value) == "integer") {
                        // error_log("Bind (int)".$key." ".$value);
                        //$select->bindParam($key, $value, PDO::PARAM_INT);
                        $select->bindParam(':' . $key, $data->__get($value), PDO::PARAM_INT);

                        // $select->bindParam(':' . $key, $value, PDO::PARAM_INT);
                    } elseif (gettype($value) == "string") {
                        // error_log("Bind (str)".$key." ".$value);
                        // $select->bindParam($key, $value, PDO::PARAM_STR);
                        // error_log($key);
                        // $data[$this->donnee]->__get($value);
                        $bp = $data->__get($keys);
                        $select->bindParam(':' . $key, $bp, PDO::PARAM_STR);
                        // error_log(':'.$key, $data->__get($value));
                    }
                }
            }
            // error_log(print_r($select, 1));
            /*
            $d1 = $data->getTitle();
            $d2 =  $data->getDescription();

            error_log($data->getTitle());
            error_log($data->getDescription());

            $select->bindParam(':title', $d1, PDO::PARAM_STR);
            $select->bindParam(':description', $d2, PDO::PARAM_STR);
            $select->bindParam(':price', $data->getPrice(), PDO::PARAM_STR);
            $select->bindParam(':date', $data->getDate(), PDO::PARAM_STR);
            $select->bindParam(':categorie', $data->getCategorie(), PDO::PARAM_STR);

            error_log(print_r($select, 1));*/
            $select->execute();
        } catch (PDOException $exception) {
            echo "Erreur de connexion : " . $exception->getMessage();
        }
    }
}
