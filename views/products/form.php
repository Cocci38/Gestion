<h1><?= isset($params['product']) ? $params['product']->getTitle() : 'Créer un nouvel article' ?></h1>

<form action="<?= isset($params['product']) ? "/gestion/update/{$params['product']->getIdProduct()}" : "/gestion/ajout" ?>" method="post">

    <label for="title">Titre</label>
    <input type="text" name="title" value="<?= isset($params['product']) ? $params['product']->getTitle() : " " ?>">

    <label for="description">Description</label>
    <textarea type="text" name="description"><?= isset($params['product']) ? $params['product']->getDescription() : " " ?> </textarea>

    <label for="price">Prix</label>
    <input type="number" name="price" value="<?= isset($params['product']) ? $params['product']->getPrice() : " " ?>">

    <label for="date">Date</label>
    <input type="date" name="date" value="<?= isset($params['product']) ? $params['product']->getDate() : " " ?>">

    <label for="Categorie">Categorie:</label><br>
    <select name="categorie_id" id="categorie">
    <option hidden><?= isset($params['product']) ? "" : " Liste des catégories " ?></option>
        <?php foreach ($params['categories'] as $categories) : ?>

            <option value="<?= $categories->id_categorie ?>" 
            <?php if (isset($params['product'])) : ?>
                <?php foreach ($params['product']->getCat() as $productCat) {
                    echo ($categories->id_categorie === $productCat->id_categorie) ? 'selected' : '';
                } ?>
            <?php endif ?>><?= $categories->getCategorie() ?></option>
        <?php endforeach ?>
    </select>

    <!-- <label for="image">Image</label>
    <input type="text" name="image"> -->

    <button type="submit">Envoyer</button>
</form>