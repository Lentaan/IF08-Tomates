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
    <form role="form" class="px-5" method='get' action='rendez-vous/choisir-une-date'>
        <?php if (isset($args['code_err']) && $args['code_err'] == 1) : ?>
            <div class="alert alert-warning mb-5" role="alert">
                Aucune disponibilité pour ce praticien
            </div>
        <?php endif; ?>
        <div class="form-group pb-4 d-flex justify-content-between gap-5">
            <div class="form-group form-floating mb-4">
                <select class="form-select" id='doctor_id' name='entity[doctor_id]'>
                    <?php
                    foreach ($results as $result) {
                        $id = $result['id'];
                        unset($result['id']);
                        printf("<option value='%s'>%s</option>", $id, implode(' : ', $result));
                    }
                    ?>
                </select>
                <label for="doctor_id">Sélectionner un praticien : </label>
            </div>
        </div>
        <button class="btn btn-primary w-100" type="submit">Choisir</button>
        <hr>
    </form>
</div>
<?php
include VIEW_DIR . 'fragment/fragmentFooter.php'; ?>

<!-- ----- fin viewInsert -->



