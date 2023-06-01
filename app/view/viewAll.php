<!-- ----- début viewAll -->
<?php

require(VIEW_DIR . 'fragment/fragmentHeader.php');
?>
<?php
include VIEW_DIR . 'fragment/fragmentMenu.php';
?>
<body>
<div class="container">
    <?php
    include VIEW_DIR . 'fragment/fragmentTitleSection.php';
    ?>

    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <?php
            for ($i = 0; $i < $nbColumns; $i++) {
                echo "<th scope='col'>$columns[$i]</th>";
            }
            unset($i);
            ?>
        </tr>
        </thead>
        <tbody>
        <?php
        // La liste des recoltes est dans une variable $results
        foreach ($results as $element) {
            $row = '<tr>';
            for ($i = 0; $i < $nbColumns; $i++) {
                $row .= printf("<td>%s</td>", $element[$columns[$i]]);
            }
            $row = '</tr>';
            echo $row;
            unset($row);
        }
        unset($nbColumns);
        unset($columns);
        unset($results);
        unset($element);
        ?>
        </tbody>
    </table>
</div>
<?php
include VIEW_DIR . 'fragment/fragmentFooter.php'; ?>

<!-- ----- fin viewAll -->
  
  
  