<?php

namespace App\Controllers;

class ManagementController extends Controller{

    public function index()
    {
        echo 'Je suis la homepage';
    }

    public function show(int $id)
    {
        echo 'Je suis l\'article ' . $id;
    }
}




?>