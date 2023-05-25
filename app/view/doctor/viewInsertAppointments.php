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
    <form role="form" class="px-5" method='get' action='disponibilite/cree'>
        <div class="form-group pb-4 d-flex justify-content-between gap-5">
            <div class="form-floating mb-3 w-50">
                <input class="form-control" required value='2023-05-23' placeholder="23/05/2023" id="appt_date" type="date" name='entity[appt_date]'>
                <label for="appt_date">Jour disponible : </label>
            </div>
            <div class="form-floating mb-3 w-50">
                <input class="form-control" value='1' required min="1" max="10" placeholder="1" id="label" type="number" name='entity[hours]'>
                <label for="label">Nombre d'heures disponible : </label>
            </div>
        </div>
        <button class="btn btn-primary w-100" type="submit">Ajouter</button>
        <hr>
    </form>
</div>
<?php
include $root . '/app/view/fragment/fragmentFooter.php'; ?>

<!-- ----- fin viewInsert -->



