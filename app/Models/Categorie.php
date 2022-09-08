<?php

namespace App\Models;

use PDO;

class Categorie extends Model
{
    protected $categorie;
    public $table = "categories";
    protected $donnee = [];

    public function getIdCategorie()
    {
        return $this->id_categorie;
    }

    public function setIdCategorie($id_categorie)
    {
        $this->id_categorie = $id_categorie;
        return $this;
    }

    public function getCategorie()
    {
        return $this->categorie;
    }

    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;
        return $this;
    }

    public function __set($prop, $value)
    {
        // if (array_key_exists($prop, $this->donnee)) {
            $this->donnee[$prop] = $value;
        // }
    }

    public function __get($prop)
    {
        // if (array_key_exists($prop, $this->donnee)) {
            return $this->donnee[$prop];
        // }
    }

    /**
     * Méthode pour afficher les produits par catégorie
     */
    // public function getProduct()
    // {
    //     $select = $this->db->getPDO()->prepare("SELECT p.* FROM produits p INNER JOIN produits_categories pc ON pc.produit_id = p.id_produit WHERE pc.categorie_id = $this->id_categorie");
    //     $select->execute();
    //     return $select->fetchAll(PDO::FETCH_OBJ);
    // }
}