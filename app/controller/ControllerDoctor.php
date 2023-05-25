<?php
require_once MODEL_DIR . 'ModelUser.php';
require_once MODEL_DIR . 'ModelSpeciality.php';
require_once MODEL_DIR . 'ModelAppointment.php';
class ControllerDoctor
{
    public static function freeAppointmentList() {
        include "config.php";
        $results = ModelAppointment::getDoctorFreeAppt($user->getId());
        $nbColumns = 1;
        $columns = ['disponibilité'];
        $title .= ' | Disponibilités';
        $slogan = "Liste de mes disponibilités";
        $vue = $root . '/app/view/viewAll.php';
        if (DEBUG) {
            echo("ControllerAdmin : userReadOne : vue = $vue");
        }
        require($vue);
    }

    public static function appointmentsCreate() {
        // ----- Construction chemin de la vue
        include 'config.php';
        $title .= ' | Praticien';
        $slogan = "Ajout de disponibilités";
        $vue = $root . '/app/view/doctor/viewInsertAppointments.php';
        if (DEBUG) {
            echo("ControllerAdmin : userCreate : vue = $vue");
        }
        require($vue);
    }

    public static function appointmentsCreated($args)
    {
        include 'config.php';
        // ajouter une validation des informations du formulaire
        $appointments = array_map('Model::processChars', $args['entity']);
        $appointments['max'] = 10;
        $appointments['id'] = $user->getId();

        $results = ModelAppointment::insertMultipleFree($appointments);
        // ----- Construction chemin de la vue
        $title .= ' | Praticien';
        $slogan = "Disponibilités de rendez-vous crée";
        $entity_name = "Les nouvelles disponibilités ";
        $vue = $root . '/app/view/viewInserted.php';
        if (DEBUG) {
            echo("ControllerAdmin : specialityCreated : vue = $vue");
        }
        require($vue);
    }

    public static function appointmentsWithPatient() {
        include "config.php";
        list($nbColumns, $columns, $results) = ModelAppointment::getAppointmentsWithPatient($user->getId());
        $title .= ' | Rendez-vous';
        $slogan = "Liste de mes rendez-vous";
        $vue = $root . '/app/view/viewAll.php';
        if (DEBUG) {
            echo("ControllerAdmin : userReadOne : vue = $vue");
        }
        require($vue);
    }

    public static function distinctPatientList() {
        include "config.php";
        list($nbColumns, $columns, $results) = ModelAppointment::getDistinctPatientList($user->getId());
        $title .= ' | Praticien';
        $slogan = "Liste de mes patients";
        $vue = $root . '/app/view/viewAll.php';
        if (DEBUG) {
            echo("ControllerAdmin : userReadOne : vue = $vue");
        }
        require($vue);
    }
}