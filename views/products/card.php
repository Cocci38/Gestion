<button type="button"><a href="/gestion/produits">Retour</a></button>
<h1><?= $params['product']->getTitle()?></h1>
<p><?= $params['product']->getDescription()?></p>
<p><?= $params['product']->getprice()/100?>€</p>
<p><?= $params['product']->getCategorie()?></p>
<p><?= $params['product']->getCreatedAt()?></p>
<button type="submit">Modifier</button>
<!-- <button type="submit"><a href="/gestion/delete/<?= $params['product']->getIdProduct() ?>"></a>Supprimer</button> -->
<form action="/gestion/delete/<?= $params['product']->getIdProduct() ?>" method="POST" class="d-inline">
    <button class="seebtn" type="submit" class="">Supprimer</button>
</form>