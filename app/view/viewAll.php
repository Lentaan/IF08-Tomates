<!-- ----- début viewAll -->
<?php

require($root . '/app/view/fragment/fragmentHeader.php');
?>
<?php
include $root . '/app/view/fragment/fragmentMenu.php';
?>
<body>
<div class="container">
    <?php
    include $root . '/app/view/fragment/fragmentTitleSection.php';
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
include $root . '/app/view/fragment/fragmentFooter.php'; ?>

<!-- ----- fin viewAll -->
  
  
  