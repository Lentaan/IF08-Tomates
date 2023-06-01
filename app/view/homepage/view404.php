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

    <div class="text-center">
        <h2>404</h2>
        <h3>Oups ! Aucune page trouvée pour cette url</h3>
        <a class="btn btn-primary mt-5" href="<?php BASE_URL ?>">Retour à la page d'accueil</a>
    </div>

</div>

<?php
include VIEW_DIR . 'fragment/fragmentFooter.php'; ?>

<!-- ----- fin viewId -->