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
    <form role="form" class="px-5" method='get' action='router2.php'>
        <div class="form-group pb-4 d-flex justify-content-between gap-5">
            <input type="hidden" name='action' value='appointmentCreated'>
            <input type="hidden" name='entity[doctor_id]' value='<?= $args['entity']['doctor_id'] ?>'>
            <div class="form-group form-floating mb-4">
                <select class="form-select" id='appt' name='entity[appt]'>
                    <?php
                    foreach ($results as $result) {
                        printf("<option value='%s'>%s</option>", $result['disponibilité'], $result['disponibilité']);
                    }
                    ?>
                </select>
                <label for="appt">Sélectionner une date : </label>
            </div>
        </div>
        <button class="btn btn-primary w-100" type="submit">Ajouter</button>
        <hr>
    </form>
</div>
<?php
include $root . '/app/view/fragment/fragmentFooter.php'; ?>

<!-- ----- fin viewInsert -->



