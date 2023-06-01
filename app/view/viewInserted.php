<!-- ----- début viewInserted -->
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

    include VIEW_DIR . 'fragment/fragmentFooter.php';
    ?>
    <!-- ----- fin viewInserted -->    

    
    