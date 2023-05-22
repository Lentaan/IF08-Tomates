<!-- ----- debut de la page propositions -->
<?php
include($root . '/app/view/fragment/fragmentHeader.php'); ?>
<body>
<?php
include($root . '/app/view/fragment/fragmentMenu.php');
?>
<div class="container-fluid">
    <?php
    include($root . '/app/view/fragment/fragmentTitleSection.php');
    ?>
    <div class="container row m-auto bg-light-subtle p-5 rounded-5">
        <div data-bs-theme="dark" class="col-6 p-5 bg-primary rounded-start-5">
            <h2 class="h2">Proposition 1 : Router</h2>
            <p class="h3 fs-4">Créer un meilleur router</p>
            <hr>
            <ul data-bs-theme="light" class="list-group">
                <li class="list-group-item list-group-item-primary">Avoir dans l'url le chemin avec des path :
                    td11_mvc1/vin/view ou td11_mvc1/vin/{id}
                </li>
                <li class="list-group-item list-group-item-primary">Remplacer le switch avec les actions par un parser
                    d'url pour retrouver le nom du controller et le nom de l'action et vérifier automatiquement si
                    l'action est disponible et public
                </li>
                <li class="list-group-item list-group-item-primary">Avoir des constantes fragments/view/controller
                    directory dans le fichier de config pour faciliter les include/require
                </li>
                <li class="list-group-item list-group-item-primary">Appeler le fichier de config dans le router, et si
                    besoin des fichiers de config spécialisé pour le controller
                </li>
            </ul>
        </div>
        <div data-bs-theme="dark" class="col-6 p-5 bg-dark rounded-end-5">
            <h2 class="h2">Proposition 2 : Layout</h2>
            <p class="h3 fs-4">Créer des layout</p>
            <hr class="border-light">
            <ul class="list-group">
                <li class="list-group-item list-group-item-light">Avoir des layouts où on peut juste donner le nombre de
                    colonne et le titre par exemple de la page
                </li>
                <li class="list-group-item list-group-item-light">Ou un layout qui permet de ne pas réécrire le menu,
                    header, footer <br> (créer deux variables avec le nom du layout et le nom du fragment de contenu par
                    exemple qu'on peut récupérer et appeler)
                </li>
                <li class="list-group-item list-group-item-light">Faire un controller général ou un trait pour les
                    controller avec des fonctions qui aident à constituer un layout
                </li>
                <li class="list-group-item list-group-item-light">Faire des layout/fonction pour générer automatiquement
                    les champs de formulaires (helper ?)
                </li>
            </ul>
        </div>
    </div>
</div>

<?php
include($root . '/app/view/fragment/fragmentFooter.php');
?>

<!-- ----- fin de la page propositions -->

</body>
</html>
