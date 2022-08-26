<?php

namespace App\Models;

use DateTime;

class Product extends Model {

    protected $id_produit;
    protected $title;
    protected $description;
    protected $price;
    protected $date;
    protected $categorie;
    protected $image;
    public $table = 'produits';

    public function getCreatedAt(): string
    // Méthode pour récupérer la date dans le format voulu
    {
        return (new DateTime($this->date))->format('d/m/Y');
    }

    public function getIdProduct()
    {
        return $this->id_produit;
    }

    public function setid_produit($id_produit)
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

    public function getCategorie()
    {
        return $this->categorie;
    }

    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;
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

    public function create(Model $data, ?array $relation = null)
    {
        parent::create($data);

        return true;
    }
}

?>