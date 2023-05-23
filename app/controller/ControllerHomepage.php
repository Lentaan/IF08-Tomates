<?php
require_once '../model/ModelUser.php';
require_once '../model/ModelSpeciality.php';

class ControllerHomepage
{
// --- page d'acceuil
    public static function viewHomepage($args)
    {
        include 'config.php';
        if (isset($_POST) && isset($_POST['user'])) {
            $user = new ModelUser(array_map('Model::processChars', $_POST['user']));
            $user = ModelUser::login($user);
            if ($user) {
                $_SESSION['user'] = $user = new ModelUser($user);
            } else {
                header('Location: /app/router/router2.php?action=login&code_err=2');
            }
        }
        $vue = $root . '/app/view/homepage/viewHomepage.php';
        if (DEBUG) {
            echo("ControllerHomepage : viewHomepage : vue = $vue");
        }
        require($vue);
    }

    public static function mesPropositions($args)
    {
        include 'config.php';
        $vue = $root . '/app/view/homepage/viewInnovations.php';
        if (DEBUG) {
            echo("ControllerHomepage : mesPropositions : vue = $vue");
        }
        require($vue);
    }

    public static function login($args) {
        include 'config.php';
        $vue = $root . '/app/view/homepage/viewLogin.php';
        if (DEBUG) {
            echo("ControllerHomepage : login : vue = $vue");
        }
        require($vue);
    }

    public static function subscribe($args) {
        include 'config.php';
        $results = ModelSpeciality::getAll()[2];
        $vue = $root . '/app/view/homepage/viewSubscribe.php';
        if (DEBUG) {
            echo("ControllerHomepage : subscribe : vue = $vue");
        }
        require($vue);
    }
    public static function subscribed($args) {
        include 'config.php';
        $newUser = array_map('Model::processChars', $_POST['user']);
        $results = ModelUser::insert($newUser);
        if ($results) {
            header('Location: /app/router/router2.php?action=login&code_suc=1&id='.$results);
        } else {
            header('Location: /app/router/router2.php?action=subscribe&code_err=1');
        }

    }

    public static function upgradeInnov() {
        include 'config.php';
        $vue = $root . '/app/view/homepage/viewUpgradeInnov.php';
        if (DEBUG) {
            echo("ControllerHomepage : upgradeInnov : vue = $vue");
        }
        require($vue);
    }

    public static function originalInnov() {
        include 'config.php';
        $vue = $root . '/app/view/homepage/viewOriginalInnov.php';
        if (DEBUG) {
            echo("ControllerHomepage : originalInnov : vue = $vue");
        }
        require($vue);
    }
}