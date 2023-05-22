<!-- ----- début viewInserted -->
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
    ?>
    <!-- ===================================================== -->
    <?php

    if (isset($results) && is_array($results)) {
        printf("<h3>%s</h3>", $results[1]);
    } elseif (isset($results) && isset($entity_name)) {
        printf("<h3>%s a été ajouté </h3>", $entity_name);
        echo("<ul>");
        foreach ($_GET['entity'] as $property => $value) {
            echo("<li>$property = $value</li>");
        }
        echo("</ul>");
    }  else {
        printf("<h3>Problème d'insertion %s</h3>", $entity_name);
        echo("id = " . $_GET['entity']['id']);
    }

    echo("</div>");

    include $root . '/app/view/fragment/fragmentFooter.php';
    ?>
    <!-- ----- fin viewInserted -->    

    
    