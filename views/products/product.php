<?php foreach ($params['products'] as $product) : ?>
    <h1><?= $product->getTitle() ?></h1>
    <p>ID : <?= $product->getIdProduct() ?></p>
    <p>Prix : <?= $product->getPrice() / 100 ?>€</p>
    <?php foreach ($product->getCat() as $cat) : ?>
        <p>Catégorie : <?= $cat->categorie ?></p>
    <?php endforeach ?>

    <button type="submit"><a href="produits/<?= $product->getIdProduct() ?>"> Fiche</a></button>
<?php endforeach ?>
<button><a href="/gestion/ajout">Ajouter</a></button>