<!-- ----- début viewAll -->
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
</div>
<?php
include VIEW_DIR . 'fragment/fragmentFooter.php'; ?>

<!-- ----- fin viewAll -->
  
  
  