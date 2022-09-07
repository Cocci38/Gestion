<?php

namespace App\Models;

use PDO;
use DateTime;

class Product extends Model
{

    protected $id_produit;
    protected $title;
    protected $description;
    protected $price;
    protected $date;
    // protected $categorie;
    protected $image;
    public $id = 'id_produit';
    public $table = 'produits';
    protected $donnee = [];

    public function getCreatedAt(): string
    // Méthode pour récupérer la date dans le format voulu
    {
        return (new DateTime($this->date))->format('d/m/Y');
    }

    // public function __get($prop)
    // {switch ($prop) {
    //     case 'tab':
    //         return $this->donnee;
    //         break;
    // }
    //     return $this->donnee[$prop];
    // }

    public function getIdProduct()
    {
        return $this->id_produit;
    }

    public function setIdProduct($id_produit)
    {
        $this->id_produit = $id_produit;
        return $this;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price)
    {
        $this->price = $price;
        return $this;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function setDate($date)
    {
        $this->date = $date;
        return $this;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image)
    {
        $this->image = $image;
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
     * Méthode pour afficher les catégories
     */
    public function getCat()
    {
        $select = $this->db->getPDO()->prepare("SELECT c.* FROM categories c INNER JOIN produits_categories pc ON pc.categorie_id = c.id_categorie WHERE pc.produit_id = $this->id_produit");
        $select->execute();
        return $select->fetchAll(PDO::FETCH_OBJ);
    }

    public function create(Model $data, ?array $relations = null)
    {
        parent::create($data);

        $id = $this->db->getPDO()->lastInsertId();
        $id = htmlspecialchars(trim(strip_tags(stripslashes($id))));

        $select = $this->db->getPDO()->prepare("SELECT id_categorie FROM categories");
        $select->execute();
        $result = $select->fetchAll(PDO::FETCH_OBJ);

        print_r($result);die;
        foreach ($relations as $catId) {
            $insert = $this->db->getPDO()->prepare("INSERT produits_categories (produit_id, categorie_id) VALUES ($id, $catId)");
            $insert->bindValue('produit_id', $id, PDO::PARAM_INT);
            $insert->bindValue('categorie_id', $catId, PDO::PARAM_INT);
            $insert->execute();
        }

        return true;
    }

    public function update(int $id, Model $data, ?array $relations = null)
    {
        parent::update($id, $data);

        foreach ($relations as $catId) {
            $update = $this->db->getPDO()->prepare("UPDATE produits_categories SET categorie_id = $catId WHERE produit_id = $id");
            $update->bindValue('categorie_id', $catId, PDO::PARAM_INT);
            $update->execute();
        }
            return true;

    }

    public function delete(int $id)
    {
        parent::delete($id);

        $delete = $this->db->getPDO()->prepare("DELETE FROM produits_categories WHERE produit_id = ?");
        $result = $delete->execute([$id]);

        if ($result) {
            return true;
        }
    }
}
