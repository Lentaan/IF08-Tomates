<?php
session_start();
$_SESSION['user'] = null;
unset($user);
header('Location: app/router/router2.php?action=truc');

?>

