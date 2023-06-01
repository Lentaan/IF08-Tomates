<!-- ----- début viewId -->
<?php
require(VIEW_DIR . 'fragment/fragmentHeader.php');
?>

<body>
<?php
include VIEW_DIR . 'fragment/fragmentMenu.php';
?>
<div class="container">
    <?php
    include VIEW_DIR . 'fragment/fragmentTitleSection.php';

    // $results contient un tableau avec la liste des clés.
    ?>
    <?php foreach ($results as $name => $result) : ?>
        <h2>Liste des <?= $name ?></h2>
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <?php foreach($result[0] as $column) : ?>
                    <th scope="col"><?= $column ?></th>
                <?php endforeach; ?>
            </tr>
            </thead>
            <tbody>
            <?php
            // La liste des users est dans une variable $results
            foreach($result[1] as $row) : ?>
                <tr>
                    <?php foreach($result[0] as $column) : ?>
                        <td><?= $row[$column] ?></td>
                    <?php endforeach; ?>
                </tr>
            <?php endforeach;?>
            </tbody>
        </table>
        <hr>
    <?php endforeach; ?>

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
include VIEW_DIR . 'fragment/fragmentFooter.php'; ?>

<!-- ----- fin viewId -->
