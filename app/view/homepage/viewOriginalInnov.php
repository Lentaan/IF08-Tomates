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

    <div class="container row m-auto bg-light-subtle p-5 rounded-5">
        <div data-bs-theme="dark" class="col-6 p-5 bg-primary rounded-start-5">
            <h2 class="h2">Proposition 1 : Statistiques</h2>
            <p class="h3 fs-4">Faire des statistique sur les praticiens</p>
            <hr>
            <ul data-bs-theme="light" class="list-group list-group-numbered">
                <li class="list-group-item list-group-item-primary">
                    Les praticiens les plus demandés
                </li>
                <li class="list-group-item list-group-item-primary">
                    Les praticiens avec le plus de disponibilités
                </li>
                <li class="list-group-item list-group-item-primary">
                    La ville la plus populaire des praticiens
                </li>
                <li class="list-group-item list-group-item-primary">
                    La spécialité la plus répandue des praticiens
                </li>
            </ul>
        </div>
        <div data-bs-theme="dark" class="col-6 p-5 bg-dark rounded-end-5">
            <h2 class="h2">Proposition 2 : Profil</h2>
            <p class="h3 fs-4">Créer un dashboard patient</p>
            <hr class="border-light">
            <ul class="list-group list-group-numbered">
                <li class="list-group-item list-group-item-light">
                    Les médecins les plus proches, qui ont la même adresse
                </li>
                <li class="list-group-item list-group-item-light">
                    La disponibilité la plus proche pour une spécialité de praticien
                </li>
                <li class="list-group-item list-group-item-light">
                    Les praticiens disponibles un jour/heure précis
                </li>
                <li class="list-group-item list-group-item-light">
                    Le praticien le plus populaire par spécialité et adresse
                </li>
            </ul>
        </div>
    </div>
</div>
<?php
include $root . '/app/view/fragment/fragmentFooter.php'; ?>

<!-- ----- fin viewId -->
