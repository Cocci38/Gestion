<!-- <a href="/gestion/produits" class="btn btn-primary">Retour</a> -->

<div class="card border-primary mb-3">
    <div class="card-header ">
        <h1 class="fs-3"><?= $params['product']->getTitle() ?></h1>
    </div>
    <div class="card-body">
        <p class="card-text"><?= $params['product']->getDescription() ?></p>
        <p class="card-text"><?= $params['product']->getprice() / 100 ?>€</p>
        <?php foreach ($params['product']->getCat() as $cat) : ?>
            <p class="card-text">Catégorie : <?= $cat->categorie ?></p>
        <?php endforeach ?>
        <p><?= $params['product']->getCreatedAt() ?></p>
        <div class="d-flex flex-wrap flex-row justify-content-center align-content-center gap-3" >
        <a href="/gestion/update/<?= $params['product']->getIdProduct() ?>" class="btn btn-warning" style="width: 200px;">Modifier</a>
        <form action="/gestion/delete/<?= $params['product']->getIdProduct() ?>" method="POST" class="d-inline" >
            <button type="submit" class="btn btn-danger " style="width: 200px;">Supprimer</button>
        </form>
        </div>