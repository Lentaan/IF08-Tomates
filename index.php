<?php
include_once('global_const.php');
session_start();
$_SESSION['user'] = null;
unset($user);
header('Location: '. BASE_URL);

?>

