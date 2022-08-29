<?php

namespace App\Controllers;

use App\Models\Product;

class ManagementController extends Controller
{

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
        $product = new Product($this->getDB());
        $product = $product->readById($id);
        return $this->view('products.card', compact('product'));
    }

    public function create()
    {
        return $this->view('products.form');
    }

    public function createProduct()
    {
        $title = htmlspecialchars(trim(strip_tags($_POST['title'])));
        $description = htmlspecialchars(trim(strip_tags($_POST['description'])));
        $price = htmlspecialchars(trim(strip_tags($_POST['price'])));
        $date = htmlspecialchars(trim(strip_tags($_POST['date'])));
        $categorie = htmlspecialchars(trim(strip_tags($_POST['categorie'])));

        if (preg_match("#^[a-zA-Z0-9-\' æœçéàèùâêîôûëïüÿÂÊÎÔÛÄËÏÖÜÀÆÇÉÈŒÙ]{3,}$#", $title) && preg_match("#^[a-zA-Z0-9-\' æœçéàèùâêîôûëïüÿÂÊÎÔÛÄËÏÖÜÀÆÇÉÈŒÙ]{10,}$#", $description)) {
            $product = new Product($this->getDB());
            $newProduct = $product->setTitle($title)->setDescription($description)->setPrice($price)->setDate($date)->setCategorie($categorie);
            $result = $product->create($newProduct);
            if ($result) {
                return header('Location: /gestion/produits');
            }
        }
        // $tab['title'] = htmlspecialchars(trim(strip_tags($_POST['title'])));
        // $tab['description'] = htmlspecialchars(trim(strip_tags($_POST['description'])));
        // $tab['price'] = htmlspecialchars(trim(strip_tags($_POST['price'])));
        // $tab['date'] = htmlspecialchars(trim(strip_tags($_POST['date'])));
        // $tab['categorie'] = htmlspecialchars(trim(strip_tags($_POST['categorie'])));

        // // if (preg_match("#^[a-zA-Z0-9-\' æœçéàèùâêîôûëïüÿÂÊÎÔÛÄËÏÖÜÀÆÇÉÈŒÙ]{3,}$#", $title) && preg_match("#^[a-zA-Z0-9-\' æœçéàèùâêîôûëïüÿÂÊÎÔÛÄËÏÖÜÀÆÇÉÈŒÙ]{10,}$#", $description)) {
        //     $product = new Product($this->getDB());
        //     $newProduct = $product->tab;
        //     // $newProduct = $product->setTitle($title)->setDescription($description)->setPrice($price)->setDate($date)->setCategorie($categorie);
        //     $result = $product->create($newProduct);
        //     if ($result) {
        //         return header('Location: /gestion/produits');
        //     }
        // // }
    }
}
