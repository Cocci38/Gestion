<h1 class="fs-1 text-center">Liste des jeux</h1>
<div class="d-flex flex-wrap flex-row bd-highlight mb-3">
    <?php foreach ($params['products'] as $product) : ?>
        <div class="p-2 bd-highlight align-content-xl-around">
            <div class="card border-secondary mb-3 h-100 d-inline-block" style="width: 300px;">
                <h2 class="card-header fs-5 h-25 d-inline-block" style="width: 300px;"><?= $product->getTitle() ?></h2>
                <div class="card-body">
                    <?php foreach ($product->getCat() as $cat) : ?>
                        <p>Catégorie : <?= $cat->categorie ?></p>
                    <?php endforeach ?>
                    <p class="card-text">Prix : <?= $product->getPrice() / 100 ?>€</p>

                    <div class="d-grid gap-2 col-6 mx-auto">
                        <button type="submit" class="btn btn-primary"><a href="produits/<?= $product->getIdProduct() ?>"> Fiche du jeu</a></button>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach ?>
</div>
