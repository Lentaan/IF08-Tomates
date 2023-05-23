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

    <form role="form" class="container p-5 bg-light rounded" method='get' action='app/router/router2.php'>
        <input type="hidden" name='action' value='<?= $action ?>'>
        <div class="form-group form-floating mb-4">
            <select class="form-select" id='id' name='id'>
                <?php
                foreach ($results as $id) {
                    echo("<option value='$id'>$id</option>");
                }
                ?>
            </select>
            <label for="id">Sélectionner un ID : </label>
        </div>
        <button class="btn btn-primary" type="submit"><?= ucfirst($args['method']) ?></button>
    </form>
</div>

<?php
include $root . '/app/view/fragment/fragmentFooter.php'; ?>

<!-- ----- fin viewId -->