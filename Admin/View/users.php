<?php
if (isset($_SESSION['message'])) {
    echo $_SESSION['message'];
    unset($_SESSION['message']);
}

?>

<h1>ADMIN : Liste des utilisateurs</h1>

<table id="usersTable" class="display">
    <thead>
    <tr>
        <th>ID</th>
        <th>Pseudo</th>
        <th>Admin</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php if (isset($users)) {

        foreach ($users as $user): ?>
            <tr>
                <td><?= $user['id'] ?></td>
                <td><?= $user['pseudo'] ?></td>
                <td><?php echo $user['admin'] == 1 ? "oui" : "non"; ?></td>
                <td>
                    <a href="/admin/toggle_admin_status/<?=$user['id']?>">Changer droits</a>
                    <a href="/admin/delete_user/<?=$user['id']?>">Supprimer</a>
                </td>
            </tr>
        <?php endforeach;
    } ?>
    </tbody>
</table>

<script>
    $(document).ready(function() {
        $('#usersTable').DataTable({
        });
    });
</script>