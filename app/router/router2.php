<!-- ----- debut Router1 -->
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


require(CONTROLLER_DIR . 'ControllerHomepage.php');
require(CONTROLLER_DIR . 'ControllerAdmin.php');
require(CONTROLLER_DIR . 'ControllerDoctor.php');
require(CONTROLLER_DIR . 'ControllerPatient.php');

if (!isset($_SESSION)) {
    session_start();
}
if (!isset($user) && isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
}

// --- récupération de l'action passée dans l'URL
$query_string = $_SERVER['QUERY_STRING'];

// fonction parse_str permet de construire 
// une table de hachage (clé + valeur)
parse_str($query_string, $param);

// --- $action contient le nom de la méthode statique recherchée
$action = (isset($param["action"])) ? htmlspecialchars($param["action"]) : '';
$action = (isset($_POST["action"])) ? htmlspecialchars($_POST["action"]) : $action;

unset($param["action"]);

$args = $param;

// --- Liste des méthodes autorisées
switch ($action) {
    case "specialityReadAll" :
    case "specialityReadId" :
    case "specialityReadOne" :
    case "specialityCreate" :
    case "specialityCreated" :
    case "doctorReadAll" :
    case "doctorNbPerPatient" :
    case "infoReadAll" :
        if (isset($_SESSION['user']) && $_SESSION['user']->getStatus() === 0) {
            ControllerAdmin::$action($args);
        } else {
            header('Location: connexion?code_err=3');
        }
        break;
    case "freeAppointmentList" :
    case "appointmentsCreate" :
    case "appointmentsCreated" :
    case "appointmentsWithPatient" :
    case "distinctPatientList" :
        if (isset($_SESSION['user']) && $_SESSION['user']->getStatus() === 1) {
            ControllerDoctor::$action($args);
        } else {
            header('Location: connexion?code_err=3');
        }
        break;
    case "patientProfil" :
    case "appointmentsWithDoctor" :
    case "appointmentCreate" :
    case "appointmentCreated" :
    case "appointmentChooseDate" :
        if (isset($_SESSION['user']) && $_SESSION['user']->getStatus() === 2) {
            ControllerPatient::$action($args);
        } else {
            header('Location: connexion?code_err=3');
        }
        break;
    case "viewHomepage" :
    case "login" :
    case "subscribe" :
    case "subscribed" :
    case "originalInnov" :
    case "upgradeInnov" :
        ControllerHomepage::$action($args);
        break;


    // Tache par défaut
    default:
        $action = "viewHomepage";
        ControllerHomepage::$action($args);
}
?>
<!-- ----- Fin Router1 -->

