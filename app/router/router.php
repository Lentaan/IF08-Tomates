<?php

require_once MODEL_DIR . 'ModelUser.php';
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($user) && isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
}

$routes = [
  'specialite' => ['admin', 'specialityReadAll'],
  'informations' =>['admin', 'infoReadAll'],
  'specialite/selection' => ['admin', 'specialityReadId'],
  'specialite/afficher' => ['admin', 'specialityReadOne'],
  'specialite/ajouter' => ['admin', 'specialityCreate'],
  'specialite/cree' =>['admin', 'specialityCreated'],
  'praticiens' => ['admin', 'doctorReadAll'],
  'praticiens/nombre-patients' => ['admin', 'doctorNbPerPatient'],
  'disponibilite' => ['doctor', 'freeAppointmentList'],
  'disponibilite/ajouter' => ['doctor', 'appointmentsCreate'],
  'disponibilite/cree' => ['doctor', 'appointmentsCreated'],
  'rendez-vous/praticien' => ['doctor', 'appointmentsWithPatient'],
  'patients' => ['doctor', 'distinctPatientList'],
  'profil' => ['patient', 'patientProfil'],
  'rendez-vous/patient' => ['patient', 'appointmentsWithDoctor'],
  'rendez-vous/ajouter' => ['patient', 'appointmentCreate'],
  'rendez-vous/choisir-une-date' => ['patient', 'appointmentChooseDate'],
  'rendez-vous/cree' => ['patient', 'appointmentCreated'],
  '' => ['homepage', 'viewHomepage'],
  'accueil' => ['homepage', 'viewHomepage'],
  'connexion' => ['homepage', 'login'],
  'inscription' => ['homepage', 'subscribe'],
  'deconnexion' => ['homepage', 'viewHomepage'],
  'inscrit' => ['homepage', 'subscribed'],
  'innovations/amelioration-du-router' => ['homepage', 'upgradeInnov'],
  'innovations/donnees-statistiques' => ['homepage', 'originalInnov']
];

$request = rtrim(str_replace(parse_url(BASE_URL)['path'], '', $_SERVER['REQUEST_URI']), '/');
$parsed_path = parse_url($request)['path'];
$args = $_GET;
$args['method'] = $_SERVER['REQUEST_METHOD'];


if (isset($routes[$parsed_path])) {
    $route = $routes[$parsed_path];
    if ($parsed_path === '' || $parsed_path === 'deconnexion') {
        $_SESSION['user'] = null;
        unset($user);
    }
    $roles = ModelUser::getNameRoles();

    if ($route[0] !== 'homepage' && (!isset($user) || (int)$user->getStatus() !== $roles[$route[0]])) {
        header(sprintf('Location: %sconnexion?code_err=3', BASE_URL));
    }

    $controller = 'Controller' . ucfirst($route[0]);
    require_once CONTROLLER_DIR . $controller . '.php';
    $action = $route[1];
    $controller::$action($args);
} else {
    require_once CONTROLLER_DIR . 'ControllerHomepage.php';
    ControllerHomepage::display404($args);
}

