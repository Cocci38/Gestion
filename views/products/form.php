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
    <select name="categorie" id="categorie">
        <option hidden><?= isset($params['product']) ? $params['product']->getCategorie() : " Liste des catégories " ?></option>
        <?php if (isset($params['product'])) { ?>
            <optgroup label="Sony">
                <option value="PlayStation" <?= $params['product']->getCategorie() == "PlayStation" ? "selected" : "  " ?>>PlayStation</option>
                <option value="PlayStation 2" <?= $params['product']->getCategorie() == "PlayStation 2" ? "selected" : "  " ?>>PlayStation 2</option>
                <option value="PlayStation 3" <?= $params['product']->getCategorie() == "PlayStation 3" ? "selected" : "  " ?>>PlayStation 3</option>
                <option value="PlayStation 4" <?= $params['product']->getCategorie() == "PlayStation 4" ? "selected" : "  " ?>>PlayStation 4</option>
                <option value="PlayStation 5" <?= $params['product']->getCategorie() == "PlayStation 5" ? "selected" : "  " ?>>PlayStation 5</option>
            </optgroup>
            <optgroup label="Microsoft">
                <option value="Xbox" <?= $params['product']->getCategorie() == "Xbox" ? "selected" : "  " ?>>Xbox</option>
                <option value="Xbox 306" <?= $params['product']->getCategorie() == "Xbox 306" ? "selected" : "  " ?>>Xbox 306</option>
                <option value="Xbox One" <?= $params['product']->getCategorie() == "Xbox One" ? "selected" : "  " ?>>Xbox One</option>
                <option value="Xbox Series" <?= $params['product']->getCategorie() == "Xbox Series" ? "selected" : "  " ?>>Xbox Series</option>
            </optgroup>
            <optgroup label="Nintendo">
                <option value="Nintendo" <?= $params['product']->getCategorie() == "Nintendo" ? "selected" : "  " ?>>Nintendo</option>
                <option value="Super Nintendo" <?= $params['product']->getCategorie() == "Super Nintendo" ? "selected" : "  " ?>>Super Nintendo</option>
                <option value="Nintendo 64" <?= $params['product']->getCategorie() == "Nintendo 64" ? "selected" : "  " ?>>Nintendo 64</option>
                <option value="Gamecube" <?= $params['product']->getCategorie() == "Gamecube" ? "selected" : "  " ?>>Gamecube</option>
                <option value="Wii" <?= $params['product']->getCategorie() == "Wii" ? "selected" : "  " ?>>Wii</option>
                <option value="Wii U" <?= $params['product']->getCategorie() == "Wii U" ? "selected" : "  " ?>>Wii U</option>
                <option value="Switch" <?= $params['product']->getCategorie() == "Switch" ? "selected" : "  " ?>>Switch</option>
            </optgroup>
        <?php } else { ?>
            <optgroup label="Sony">
                <option value="PlayStation">PlayStation</option>
                <option value="PlayStation 2">PlayStation 2</option>
                <option value="PlayStation 3">PlayStation 3</option>
                <option value="PlayStation 4">PlayStation 4</option>
                <option value="PlayStation 5">PlayStation 5</option>
            </optgroup>
            <optgroup label="Microsoft">
                <option value="Xbox" >Xbox</option>
                <option value="Xbox 306">Xbox 306</option>
                <option value="Xbox One">Xbox One</option>
                <option value="Xbox Series" >Xbox Series</option>
            </optgroup>
            <optgroup label="Nintendo">
                <option value="Nintendo">Nintendo</option>
                <option value="Super Nintendo">Super Nintendo</option>
                <option value="Nintendo 64">Nintendo 64</option>
                <option value="Gamecube">Gamecube</option>
                <option value="Wii" >Wii</option>
                <option value="Wii U">Wii U</option>
                <option value="Switch">Switch</option>
            </optgroup>
        <?php } ?>
    </select>

    <!-- <label for="image">Image</label>
    <input type="text" name="image"> -->

    <button type="submit">Envoyer</button>
</form>