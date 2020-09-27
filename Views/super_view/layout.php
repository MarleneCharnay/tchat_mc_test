<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap-theme.css">
    <link rel="stylesheet" href="css/styles.css">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script>
        var isUserConnected = <?= isset($_SESSION['user']) ? 'true' : 'false'; ?>;
    </script>
    <title>Tchat</title>
</head>

<body>

<div class="container">
    <section>
        <h1>Tchat</h1>
        <nav class="navbar">
            <?php if (isset($_SESSION['user'])) : ?>
                <a class="btn btn-default" href="index.php?route=logout">Déconnexion</a>
            <?php endif; ?>
        </nav>

        <?php
        if (!empty($_SESSION['flashMessages'])) : ?>
        <div class="alert alert-danger" role="alert">
            <?php
            foreach ($_SESSION['flashMessages'] as $flashMessage) :
            echo $flashMessage . '<br>';
            endforeach;
            ?>
        </div>
        <?php
        unset($_SESSION['flashMessages']);
        endif;
        ?>

        <div class="col-sm-12">
            <?php echo $vue; ?>
        </div>

    </section>
</div>

<script src="js/tchat.js"></script>

</body>
</html>
