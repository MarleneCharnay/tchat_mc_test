<?php
if (isset($_SESSION['user']) && !empty($_SESSION['user'])) { ?>

    <div id="thetchat" class="col-sm-9" style="text-align: left; width: calc(100% - 150px); max-height: 600px; overflow-y: scroll">
    </div>
    <div class="col-sm-3" style="text-align: left; width: 150px;">
        <h2>Connectés</h2>
        <div id="people"></div>
    </div>

    <div id="entertext" class="col-sm-12 entertext">
        <form action="index.php?route=tchatadd" method="POST">

            <div class="form-group">
                <label for="content" class="control-label"><b>Bienvenue <?= $_SESSION['user']['pseudo'] ?></b></label>
                <input type="text" id="content" name="content" value="" class="form-control">

                <button type="submit" class="btn btn-primary">Envoyer</button>
            </div>

        </form>
    </div>

<?php } else {
    echo 'Connectez-vous pour voir la discussion et y participer.';
} ?>
