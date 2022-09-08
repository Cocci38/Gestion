<?php

namespace App\Controllers;

use PDO;
use App\Models\Product;
use App\Models\Categorie;

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
        $categories = (new Categorie($this->getDB()))->read();
        return $this->view('products.form', compact('categories'));
    }

    private function is_date_valid($date, $format = "Y-m-d")
    {
        $parsed_date = date_parse_from_format($format, $date);
        if (!$parsed_date['error_count'] && !$parsed_date['warning_count']) {
            return true;
        }
    }
    public function createProduct()
    {
        $title = htmlspecialchars(trim(strip_tags(stripslashes($_POST['title']))));
        $description = htmlspecialchars(trim(strip_tags(stripslashes($_POST['description']))));
        $price = intVal(htmlspecialchars(trim(strip_tags(stripslashes($_POST['price'])))));
        $date = htmlspecialchars(trim(strip_tags(stripslashes($_POST['date']))));
        $date = ($this->is_date_valid($date) ? $date : date('Y-m-d'));
        $categorie = htmlspecialchars(trim(strip_tags(stripslashes($_POST['categorie_id']))));

        if (
            preg_match("#^[a-zA-Z0-9-\' æœçéàèùâêîôûëïüÿÂÊÎÔÛÄËÏÖÜÀÆÇÉÈŒÙ]{3,}$#", $title)
            && preg_match("#^[a-zA-Z0-9-\' æœçéàèùâêîôûëïüÿÂÊÎÔÛÄËÏÖÜÀÆÇÉÈŒÙ]{10,}$#", $description)
        ) {
            $select = $this->db->getPDO()->prepare("SELECT id_categorie FROM categories WHERE id_categorie = $categorie");
            $select->bindValue('id_categorie', $categorie, PDO::PARAM_INT);
            $select->execute();
            $result = $select->fetchAll(PDO::FETCH_OBJ);
            // error_log(print_r($result, 1));
            if ($result) {
                // foreach ($result as $key => $value) {
                // error_log(print_r($value->id_categorie, 1));

                error_log('je passe par là');
                $product = new Product($this->getDB());
                // echo "<pre>", print_r($product, 1), "</pre>";
                $product->title = $title;
                $product->description = $description;
                $product->price = $price;
                $product->date = $date;
                // $cat = $product->getCat();
                // error_log($cat);die;
                $tags[] = $categorie;
                // error_log(print_r($product, 1));
                // $newProduct = $product->setTitle($title)->setDescription($description)->setPrice($price)->setDate($date)->setCategorie($categorie);
                $newProduct = $product;
                // error_log(print_r($newProduct, 1));
                $result = $product->create($newProduct, $tags);

                return header('Location: /gestion/produits');
            } else {
                error_log('rater pour cette fois');
                return header('Location: /gestion/ajout');
            }
        } else {
            error_log('rater pour cette fois');
            return header('Location: /gestion/ajout');
        }
    }

    public function updateProduct(int $id)
    {
        // Retourne le formulaire de modification
        $product = new Product($this->getDB());
        $product = $product->readById($id);
        $categories = (new Categorie($this->getDB()))->read();
        return $this->view('products.form', compact('product', 'categories'));
    }

    public function update(int $id)
    {
        // error_log(print_r($_POST, 1));
        $title = htmlspecialchars(trim(strip_tags(stripslashes($_POST['title']))));
        $description = htmlspecialchars(trim(strip_tags(stripslashes($_POST['description']))));
        $price = intVal(htmlspecialchars(trim(strip_tags(stripslashes($_POST['price'])))));
        $date = htmlspecialchars(trim(strip_tags(stripslashes($_POST['date']))));
        $date = ($this->is_date_valid($date) ? $date : date('Y-m-d'));
        $categorie = htmlspecialchars(trim(strip_tags(stripslashes($_POST['categorie_id']))));

        if (
            preg_match("#^[a-zA-Z0-9-\' æœçéàèùâêîôûëïüÿÂÊÎÔÛÄËÏÖÜÀÆÇÉÈŒÙ]{3,}$#", $title)
            && preg_match("#^[a-zA-Z0-9-\' æœçéàèùâêîôûëïüÿÂÊÎÔÛÄËÏÖÜÀÆÇÉÈŒÙ]{10,}$#", $description)
        ) {
            $select = $this->db->getPDO()->prepare("SELECT id_categorie FROM categories WHERE id_categorie = $categorie");
            $select->bindValue('id_categorie', $categorie, PDO::PARAM_INT);
            $select->execute();
            $result = $select->fetch(PDO::FETCH_OBJ);
            // error_log(print_r($result, 1));
            if ($result) {
                $product = new Product($this->getDB());
                // error_log(print_r($product, 1));
                $product->title = $title;
                $product->description = $description;
                $product->price = $price;
                $product->date = $date;
                $tags[] = $categorie;
                $updateProduct = $product;
                // $updateProduct = $product->setTitle($title)->setDescription($description)->setPrice($price)->setDate($date)->setCategorie($categorie);
                // echo "<pre>",print_r($_FILES),"</pre>"; die();

                $resultat = $product->update($id, $updateProduct, $tags);
                // echo "<pre>",print_r($resultat, 1),"</pre>";  die();

                return header("Location: /gestion/produits/$id");
            } else {
                error_log('rater pour cette fois');
                return header('Location: /gestion/ajout');
            }
        } else {
            error_log('rater pour cette fois');
            return header('Location: /gestion/ajout');
        }
    }

    public function delete(int $id)
    {
        $product = new Product($this->getDB());
        $delete = $product->delete($id);

        if ($delete) {
            return header("Location: /gestion/produits");
        }
    }
}
