<?php foreach ($params['products'] as $product) : ?>
    <h1><?= $product->getTitle() ?></h1>
    <p>Prix : <?= $product->getPrice() / 100 ?>€</p>
    <p>Catégorie : <?= $product->getCategorie() ?></p>
    <button type="submit"><a href="produits/<?= $product->getIdProduct() ?>"> Fiche</a></button>
<?php endforeach ?>
<button><a href="/gestion/ajout">Ajouter</a></button>