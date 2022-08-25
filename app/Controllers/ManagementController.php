<?php

namespace App\Controllers;

use App\Models\Product;

class ManagementController extends Controller{

    public function index()
    {
        echo 'Je suis la homepage';
    }

    /**
     * Méthode qui lie le model à la view
     * On crée un nouveau product 
     * Dans cette classe on va chercher la méthode read
     * On la renvoie dans la vue qui se trouve dans le dossier products et le fichier product
     * compact — Crée un tableau à partir de variables et de leur valeur (products = $products)
     */
    public function product()
    {
        $product = new Product($this->getDB());
        $products = $product->read();
        return $this->view('products.product', compact('products'));
    }

    public function productId(int $id)
    {
        echo 'Je suis l\'article ' . $id;
    }
}




?>