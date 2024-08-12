<?php
if (isset($_SESSION['message'])) {
    echo $_SESSION['message'];
    unset($_SESSION['message']);
}

?>

<h1>ADMIN : Liste des catégories</h1>

<a href="/admin/create_category_view">+ Nouvelle catégorie</a>

<table id="categoriesTable" class="display">
    <thead>
    <tr>
        <th>ID</th>
        <th>Nom</th>
        <th>Slug</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php if (isset($categories)) {

        foreach ($categories as $categorie): ?>
            <tr>
                <td><?= $categorie['id'] ?></td>
                <td><?= $categorie['name'] ?></td>
                <td><?= $categorie['cat_slug'] ?></td>
                <td>
                    <a href="/admin/edit_category_view/<?=$categorie['id']?>">Modifier</a>
                    <a href="/admin/delete_category/<?=$categorie['id']?>">Supprimer</a>
                </td>
            </tr>
        <?php endforeach;
    } ?>
    </tbody>
</table>

<script>
    $(document).ready(function() {
        $('#categoriesTable').DataTable({
        });
    });
</script>