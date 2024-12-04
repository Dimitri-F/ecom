<?php
if (isset($_SESSION['message'])) {
    echo $_SESSION['message'];
    unset($_SESSION['message']);
}

?>

<h1 class="text-center text-2xl text-orange-500 font-bold m-4">ADMIN : Liste des catégories</h1>

<a class="m-6 inline-block rounded-md bg-blue-500 px-4 py-2 text-white shadow-sm focus:relative hover:bg-blue-600 transition duration-300" href="/admin/create_category_view">+ Nouvelle catégorie</a>

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
                    <a class="m-6 inline-block rounded-md bg-yellow-500 px-4 py-2 text-white shadow-sm focus:relative hover:bg-yellow-600 transition duration-300" href="/admin/edit_category_view/<?=$categorie['id']?>">Modifier</a>
                    <a class="m-6 inline-block rounded-md bg-red-500 px-4 py-2 text-white shadow-sm focus:relative hover:bg-red-600 transition duration-300" href="/admin/delete_category/<?=$categorie['id']?>">Supprimer</a>
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