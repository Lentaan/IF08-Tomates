<!-- ----- début viewInsert -->

<?php
require(VIEW_DIR . 'fragment/fragmentHeader.php');
?>

<body>
<?php
include VIEW_DIR . 'fragment/fragmentMenu.php';
?>
<div class="pb-3 container bg-light-subtle">
    <?php
    include VIEW_DIR . 'fragment/fragmentTitleSection.php';
    ?>
    <form role="form" class="px-5" method='get' action='specialite/cree'>
        <div class="form-group pb-4 d-flex justify-content-between gap-5">
            <div class="form-floating mb-3 w-50">
                <input class="form-control" value='Dentiste' placeholder="Dentiste" id="label" type="text" name='entity[label]'>
                <label for="label">Label : </label>
            </div>
        </div>
        <button class="btn btn-primary w-100" type="submit">Ajouter</button>
        <hr>
    </form>
</div>
<?php
include VIEW_DIR . 'fragment/fragmentFooter.php'; ?>

<!-- ----- fin viewInsert -->



