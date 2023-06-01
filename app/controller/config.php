<!-- ----- debut config -->
<?php
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($user) && isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
}

// Utile pour le débugage car c'est un interrupteur pour les echos et print_r.
if (!defined('DEBUG')) {
    define('DEBUG', false, 0);
}

$title = "Doctolib";
$slogan = "Trouver les meilleurs docteurs de votre région, et prenez rendez-vous en ligne !";


// ===============
// Configuration de la base de données sur dev-isi
if ($_SERVER['HTTP_HOST'] === 'dev-isi.utt.fr') {
    $dsn = 'mysql:dbname=sattlerc;host=localhost;charset=utf8';
    $username = 'sattlerc';
    $password = 'sMtOiI09';
} else {
    $dsn = 'mysql:dbname=project;host=localhost;charset=utf8';
    $username = 'root';
    $password = '';
}

// chemin absolu vers le répertoire du projet SUR DEV-ISI



if (DEBUG) {
    echo("<ul>");
    echo(" <li>dsn = $dsn</li>");
    echo(" <li>username = $username</li>");
    echo(" <li>password = $password</li>");
    echo("<li>---</li>");
    echo(" <li>root = {$ROOT_DIR}</li>");
    echo("</ul>");
}
?>

<!-- ----- fin config -->



