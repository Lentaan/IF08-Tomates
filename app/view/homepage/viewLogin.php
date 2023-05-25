<!-- ----- début viewInsert -->

<?php
require($root . '/app/view/fragment/fragmentHeader.php');
?>

<body>
<?php
include $root . '/app/view/fragment/fragmentMenu.php';
?>
<div class="pb-3 container bg-light-subtle">
    <?php
    include $root . '/app/view/fragment/fragmentTitleSection.php';
    ?>
    <form role="form" class="px-5" method='post' action='<?= BASE_URL ?>accueil'>
        <?php if (isset($args['code_err']) && $args['code_err'] == 2) : ?>
            <div class="alert alert-danger mb-5" role="alert">
                Erreur de connexion, l'identifiant ou le mot de passe est incorrecte.
            </div>
        <?php endif; ?>
        <?php if (isset($args['code_err']) && $args['code_err'] == 3) : ?>
            <div class="alert alert-danger mb-5" role="alert">
                Vous n'avez pas les droits pour accéder à ces informations, veuillez vous connecter au bon compte.
            </div>
        <?php endif; ?>
        <?php if (isset($args['code_suc']) && $args['code_suc'] == 1) : ?>
            <div class="alert alert-success mb-5" role="alert">
                Vous vous êtes inscrit ! Félicitation ! Vous pouvez vous connecter dès à présent.
            </div>
        <?php endif; ?>
        <div class="form-group pb-4 d-flex justify-content-between gap-5">
            <div class="form-floating mb-3 w-50">
                <input class="form-control" required placeholder="Camille" id="login" type="text" name='user[login]'>
                <label for="login">Identifiant : </label>
            </div>
            <div class="form-floating mb-3 w-50">
                <input class="form-control" value='' required placeholder="..." id="label" type="password" name='user[password]'>
                <label for="label">Mot de passe : </label>
            </div>
        </div>
        <button class="btn btn-primary w-100" type="submit">Se connecter</button>
        <hr>
    </form>
</div>
<?php
include $root . '/app/view/fragment/fragmentFooter.php'; ?>

<!-- ----- fin viewInsert -->



