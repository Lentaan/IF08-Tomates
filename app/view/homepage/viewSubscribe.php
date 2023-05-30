<!-- ----- début viewId -->
<?php
require($root . '/app/view/fragment/fragmentHeader.php');
?>

<body>
<?php
include $root . '/app/view/fragment/fragmentMenu.php';
?>
<div class="container">
    <?php
    include $root . '/app/view/fragment/fragmentTitleSection.php';

    // $results contient un tableau avec la liste des clés.
    ?>

    <form role="form" class="container p-5 bg-light rounded" method='post' action='inscrit'>
        <?php if (isset($args['code_err']) && $args['code_err'] == 1) : ?>
            <div class="alert alert-danger mb-5" role="alert">
                Il y a eu un soucis lors de votre inscription, veuillez réessayer
            </div>
        <?php endif; ?>
        <div class="form-group pb-4 d-flex justify-content-between gap-5">
            <div class="form-floating mb-3 w-50">
                <input class="form-control" placeholder="Champs" id="lastname" type="text" name='user[lastname]'>
                <label for="lastname">Nom : </label>
            </div>
            <div class="form-floating mb-3 w-50">
                <input class="form-control" placeholder="Pâquerette" id="firstname" type="text" name='user[firstname]'>
                <label for="firstname">Prénom : </label>
            </div>
            <div class="form-floating mb-3 w-50">
                <input class="form-control" placeholder="Paris" id="address" type="text" name='user[address]'>
                <label for="address">Adresse : </label>
            </div>
        </div>
        <div class="form-group pb-4 d-flex justify-content-between gap-5">
            <div class="form-floating mb-3 w-50">
                <input class="form-control" placeholder="Champs" id="login" type="text" name='user[login]'>
                <label for="login">Identifiant : </label>
            </div>
            <div class="form-floating mb-3 w-50">
                <input class="form-control" placeholder="Pâquerette" id="password" type="password" name='user[password]'>
                <label for="password">Mot de passe : </label>
            </div>
        </div>
        <div class="form-group form-floating mb-5">
            <select class="form-select" id='speciality_id' name='user[status]'>
                <option value="0">Administrateur</option>
                <option value="1">Praticien</option>
                <option value="2">Patient</option>
            </select>
            <label for="speciality_id">Sélectionner votre statut : </label>
        </div>
        <div class="form-group form-floating mb-4">
            <select class="form-select" id='speciality_id' name='user[speciality_id]'>
                <?php
                foreach ($results as $result) {
                    printf("<option value='%s'>%s</option>", $result['id'], $result['label']);
                }
                ?>
            </select>
            <label for="speciality_id">Sélectionner une spécialité: </label>
            <small id="passwordHelpBlock" class="form-text text-muted">
                N'en sélectionné une seulement si vous êtes praticien.
            </small>
        </div>
        <a class="btn btn-dark" href="connexion">Retour connexion</a>
        <button class="btn btn-primary" type="submit">S'inscrire</button>
    </form>
</div>

<?php
include $root . '/app/view/fragment/fragmentFooter.php'; ?>

<!-- ----- fin viewId -->