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
            <input type="hidden" name='action' value='specialityCreated'>
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
include $root . '/app/view/fragment/fragmentFooter.php'; ?>

<!-- ----- fin viewInsert -->



