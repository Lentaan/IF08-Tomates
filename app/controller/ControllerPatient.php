<?php
require_once MODEL_DIR . 'ModelUser.php';
require_once MODEL_DIR . 'ModelSpeciality.php';
require_once MODEL_DIR . 'ModelAppointment.php';
class ControllerPatient
{
    public static function patientProfil($args)
    {
        include 'config.php';
        list($nbColumns, $columns, $results) = ModelUser::getOne($user->getId());
        // ----- Construction chemin de la vue
        $title .= ' | Profil';
        $slogan = "Toutes mes informations";
        $vue = $root . '/app/view/viewAll.php';
        if (DEBUG) {
            echo("ControllerPatient : patientReadOne : vue = $vue");
        }
        require($vue);
    }

    public static function appointmentsWithDoctor($args) {
        include 'config.php';
        list($nbColumns, $columns, $results) = ModelAppointment::getAppointmentsWithDoctor($user->getId());
        // ----- Construction chemin de la vue
        $title .= ' | Rendez-vous';
        $slogan = "Tous mes prochains rendez-vous";
        $vue = $root . '/app/view/viewAll.php';
        if (DEBUG) {
            echo("ControllerPatient : patientReadOne : vue = $vue");
        }
        require($vue);
    }

    public static function appointmentCreate() {
        // ----- Construction chemin de la vue
        include 'config.php';
        $results = ModelUser::getAllDoctor()[2];
        $title .= ' | Rendez-vous';
        $slogan = "Prendre un nouveau rendez-vous";
        $vue = $root . '/app/view/patient/viewInsertAppointment.php';
        if (DEBUG) {
            echo("ControllerAdmin : userCreate : vue = $vue");
        }
        require($vue);
    }
    public static function appointmentChooseDate($args) {
        // ----- Construction chemin de la vue
        include 'config.php';
        $results = ModelAppointment::getDoctorFreeAppt($args['entity']['doctor_id']);
        $title .= ' | Rendez-vous';
        $slogan = "Prendre un nouveau rendez-vous - 2";
        $vue = $root . '/app/view/patient/viewInsertDate.php';
        if (DEBUG) {
            echo("ControllerAdmin : userCreate : vue = $vue");
        }
        require($vue);
    }

    public static function appointmentCreated($args)
    {
        include 'config.php';
        $args['entity']['patient_id'] = $user->getId();
        // ajouter une validation des informations du formulaire
        $appt = array_map('Model::processChars', $args['entity']);

        $results = ModelAppointment::update($appt);
        // ----- Construction chemin de la vue
        $title .= ' | Rendez-vous';
        $slogan = "Rendez-vous pris";
        $entity_name = "Le nouveau rendez-vous ";
        $vue = $root . '/app/view/viewInserted.php';
        if (DEBUG) {
            echo("ControllerAdmin : specialityCreated : vue = $vue");
        }
        require($vue);
    }
}

