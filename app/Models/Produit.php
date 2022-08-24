<?php

namespace App\Models;

class Produit extends Model {

    protected $title;
    protected $description;
    protected $price;
    protected $date;
    protected $categorie;
    protected $image;
    public $table = 'produits';
}

?>