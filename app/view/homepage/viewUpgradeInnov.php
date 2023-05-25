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
    <div class="container d-flex justify-content-center m-auto bg-light-subtle p-5 rounded-5">
        <div data-bs-theme="dark" class=" p-5 bg-dark rounded-5">
            <h2 class="h2">Proposition : Amélioration du router</h2>
            <p class="h3 fs-4">Création de joli chemin dans l'url</p>
            <hr class="border-light">
            <ul class="list-group list-group-numbered">
                <li class="list-group-item list-group-item-light">
                    Le chemin de déconnexion de change pas par rapport au sujet
                    <br><small>(on peut se déconnecter en allant sur la base de l'url du projet ou en écrivant déconnexion)</small>
                </li>
                <li class="list-group-item list-group-item-light">
                    Le chemin accueil a été ajouté pour que la déconnexion ne se déclenche pas quand on veut ramener un utilisateur à l'accueil après une connexion
                </li>
                <li class="list-group-item list-group-item-light">
                    Les personnes des différents rôles ne peuvent pas accéder aux pages des autres rôles
                </li>
                <li class="list-group-item list-group-item-light">
                    Une mauvaise url vous ramène à la page 404
                </li>
                <li class="list-group-item list-group-item-light">
                    Les chemins corrects sont tous disponibles dans le menu de chaque rôle
                </li>
                <li class="list-group-item list-group-item-light">
                    Les chemins de l'url sont parsé et associé à une route dans le fichier app/router/routes.php qui lui donne le controller et la méthode
                </li>
                <li class="list-group-item list-group-item-light">
                    Des constantes globales sont disponibles dans global_const.php pour changer par exemple l'URL de base du projet
                </li>
            </ul>
        </div>
    </div>
</div>
    <?php
    include $root . '/app/view/fragment/fragmentFooter.php'; ?>

    <!-- ----- fin viewId -->
