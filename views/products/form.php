<form action="/gestion/ajout" method="post">

    <label for="title">Titre</label>
    <input type="text" name="title">

    <label for="description">Description</label>
    <input type="text" name="description">

    <label for="price">Prix</label>
    <input type="number" name="price">

    <label for="date">Date</label>
    <input type="date" name="date">

    <label for="Categorie">Categorie:</label><br>
    <select name="categorie" id="categorie">
        <option hidden>Liste des catégories</option>
        <optgroup label="Sony">
            <option value="PlayStation">PlayStation</option>
            <option value="PlayStation 2">PlayStation 2</option>
            <option value="PlayStation 3">PlayStation 3</option>
            <option value="PlayStation 4">PlayStation 4</option>
            <option value="PlayStation 5">PlayStation 5</option>
        </optgroup>
        <optgroup label="Microsoft">
            <option value="Xbox">Xbox</option>
            <option value="Xbox 306">Xbox 306</option>
            <option value="Xbox One">Xbox One</option>
            <option value="Xbox Series">Xbox Series</option>
        </optgroup>
        <optgroup label="Nintendo">
            <option value="Nintendo">Nintendo</option>
            <option value="Super Nintendo">Super Nintendo</option>
            <option value="Nintendo 64">Nintendo 64</option>
            <option value="Gamecube">Gamecube</option>
            <option value="Wii">Wii</option>
            <option value="Wii U">Wii U</option>
            <option value="Switch">Switch</option>
        </optgroup>
    </select>

    <!-- <label for="image">Image</label>
    <input type="text" name="image"> -->

    <button type="submit">Envoyer</button>
</form>