<button type="button"><a href="/gestion/produits">Retour</a></button>
<h1><?= $params['product']->getTitle() ?></h1>
<p><?= $params['product']->getDescription() ?></p>
<p><?= $params['product']->getprice() / 100 ?>€</p>
<?php foreach ($params['product']->getCat() as $cat) : ?>
    <p>Catégorie : <?= $cat->categorie ?></p>
<?php endforeach ?>
<p><?= $params['product']->getCreatedAt() ?></p>
<a href="/gestion/update/<?= $params['product']->getIdProduct() ?>">Modifier</a>
<form action="/gestion/delete/<?= $params['product']->getIdProduct() ?>" method="POST" class="d-inline">
    <button class="seebtn" type="submit" class="">Supprimer</button>
</form>