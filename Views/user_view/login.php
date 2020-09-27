<h2>Connexion</h2>

<?php
if (!empty($tab['errors'])) { ?>
    <div class="alert alert-danger" role="alert">
        <strong>
    <?php foreach ($tab['errors'] as $error) {echo "$error<br>";} ?>
        </strong>
    </div>
<?php } ?>

<form method="post" action="index.php?route=login">
    <div class="form-group">
        <label class="control-label">
            Pseudo
            <input type="text" name="pseudo" value="" class="form-control">
        </label>

    </div>
    <div class="form-group">
        <label class="control-label">
            Mot de passe
            <input type="password" name="psw" value="" class="form-control">
        </label>
    </div>

    <button type="submit" name="type-action" value="connexion" class="btn btn-primary">Connexion</button>
    <button type="submit" name="type-action" value="inscription" class="btn btn-sm btn-info">Inscription</button>
</form>

