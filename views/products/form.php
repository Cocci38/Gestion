<h1 class="fs-1 text-center"><?= isset($params['product']) ? $params['product']->getTitle() : 'Créer un nouvel article' ?></h1>

<form action="<?= isset($params['product']) ? "/gestion/update/{$params['product']->getIdProduct()}" : "/gestion/ajout" ?>" method="post" class="container-md">
    <div class="mb-3">
        <div class="form-group">
            <label for="title" class="form-label mt-4">Titre</label>
            <input type="text" name="title" value="<?= isset($params['product']) ? $params['product']->getTitle() : " " ?>" class="form-control">
        </div>
        <div class="form-group">
            <label for="description" class="form-label mt-4">Description</label>
            <textarea type="text" name="description" class="form-control"><?= isset($params['product']) ? $params['product']->getDescription() : " " ?> </textarea>
        </div>
        <div class="form-group">
            <label for="price" class="form-label mt-4">Prix</label>
            <input type="number" name="price" value="<?= isset($params['product']) ? $params['product']->getPrice() : " " ?>" class="form-control">
        </div>
        <div class="form-group">
            <label for="date" class="form-label mt-4">Date</label>
            <input type="date" name="date" value="<?= isset($params['product']) ? $params['product']->getDate() : " " ?>" class="form-control">
        </div>
        <div class="form-group">
            <label for="Categorie" class="form-label mt-4">Categorie</label><br>
            <select name="categorie_id" id="exampleSelect2" class="form-select">
                <option hidden><?= isset($params['product']) ? "" : " Liste des catégories " ?></option>
                <?php foreach ($params['categories'] as $categories) : ?>

                    <option value="<?= $categories->id_categorie ?>" <?php if (isset($params['product'])) : ?> <?php foreach ($params['product']->getCat() as $productCat) {
                                                                                                                    echo ($categories->id_categorie === $productCat->id_categorie) ? 'selected' : '';
                                                                                                                } ?> <?php endif ?>><?= $categories->getCategorie() ?></option>
                <?php endforeach ?>
            </select>
        </div>
        <!-- <label for="image">Image</label>
    <input type="text" name="image"> -->
    </div>
    <button type="submit" class="btn btn-primary">Envoyer</button>
</form>