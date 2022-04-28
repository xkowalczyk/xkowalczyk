<h3>Lista użytkowników:</h3><br>

<div class="users_list">
    <?php if ($users != null) foreach ($users as $user): ?>
        <div id="user<?= esc($user->user_id) ?>" class="user">
            <b>Użytkownik nr: <?= esc($user->user_id." (".$user->user_name." ".$user->user_lastname.")") ?></b><br>
            <form method="post" action="<?= esc(base_url('admin/usermanager')) ?>">
                <input type="hidden" name="user-id" value="<?= esc($user->user_id) ?>">
                <button type="submit">Zarządzaj użytkownikiem</button>
            </form>
        </div><br>
    <?php endforeach; ?>
</div>