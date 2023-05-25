<!-- ----- debut ControllerUser -->
<?php
require_once MODEL_DIR . 'ModelUser.php';
require_once MODEL_DIR . 'ModelSpeciality.php';
require_once MODEL_DIR . 'ModelAppointment.php';

class ControllerAdmin
{

    public static function specialityReadAll($args)
    {
        list($nbColumns, $columns, $results) = ModelSpeciality::getAll();
        // ----- Construction chemin de la vue
        include 'config.php';
        $title .= ' | Administrateur';
        $slogan = "Liste des spécialités";
        $vue = $root . '/app/view/viewAll.php';
        if (DEBUG) {
            echo("ControllerAdmin : userReadAll : vue = $vue");
        }
        require($vue);
    }

    public static function infoReadAll($args)
    {
        $results = [];
        list($nbColumns, $columns, $result) = ModelSpeciality::getAll();
        $results['spécialités'] = [$columns, $result];
        list($nbColumns, $columns, $result) = ModelUser::getAllDoctorInfo();
        $results['praticiens'] = [$columns, $result];
        list($nbColumns, $columns, $result) = ModelUser::getAllPatient();
        $results['patients'] = [$columns, $result];
        list($nbColumns, $columns, $result) = ModelUser::getAllAdmin();
        $results['administrateurs'] = [$columns, $result];
        list($nbColumns, $columns, $result) = ModelAppointment::getAll();
        $results['rendez-vous'] = [$columns, $result];
        // ----- Construction chemin de la vue
        include 'config.php';
        $title .= ' | Administrateur';
        $slogan = "Liste des informations";
        $vue = $root . '/app/view/admin/viewAllMultiple.php';
        if (DEBUG) {
            echo("ControllerAdmin : userReadAll : vue = $vue");
        }
        require($vue);
    }

    // Affiche un formulaire pour sélectionner un id qui existe
    public static function specialityReadId($args)
    {
        $results = ModelSpeciality::getAllId();
        switch ($args['method']) {
            case 'delete':
                $action = 'specialityDeleteOne';
                break;
            default:
                $action = 'specialityReadOne';
        }

        // ----- Construction chemin de la vue
        include 'config.php';
        $title .= ' | Administrateur';
        $slogan = 'Sélection d\'un id';
        $vue = $root . '/app/view/viewId.php';
        if (DEBUG) {
            echo("ControllerAdmin : userReadId : vue = $vue");
        }
        require($vue);
    }

    // Affiche un user particulier (id)
    public static function specialityReadOne($args)
    {
        $speciality_id = $_GET['id'];
        list($nbColumns, $columns, $results) = ModelSpeciality::getOne($speciality_id);

        // ----- Construction chemin de la vue
        include 'config.php';
        $title .= ' | Administrateur';
        $slogan = "Spécialité sélectionnée";
        $vue = $root . '/app/view/viewAll.php';
        if (DEBUG) {
            echo("ControllerAdmin : userReadOne : vue = $vue");
        }
        require($vue);
    }

    // Affiche le formulaire de creation d'un user
    public static function specialityCreate($args)
    {
        // ----- Construction chemin de la vue
        include 'config.php';
        $title .= ' | Administrateur';
        $slogan = "Ajout d'une spécialité";
        $vue = $root . '/app/view/admin/viewInsertSpeciality.php';
        if (DEBUG) {
            echo("ControllerAdmin : userCreate : vue = $vue");
        }
        require($vue);
    }
    public static function specialityCreated($args)
    {
        // ajouter une validation des informations du formulaire
        $speciality = array_map('Model::processChars', $args['entity']);
        $results = ModelSpeciality::insert($speciality);
        // ----- Construction chemin de la vue
        include 'config.php';
        $title .= ' | Administrateur';
        $slogan = "Spécialité crée";
        $entity_name = "La nouvelle spécialité ";
        $vue = $root . '/app/view/viewInserted.php';
        if (DEBUG) {
            echo("ControllerAdmin : specialityCreated : vue = $vue");
        }
        require($vue);
    }

    // Créer une liste sans doublons des régions
    public static function doctorReadAll($args)
    {
        list($nbColumns, $columns, $results) = ModelUser::getAllDoctor();
        // ----- Construction chemin de la vue
        include 'config.php';
        $title .= ' | Administrateur';
        $slogan = 'Liste des praticiens et de leur spécialités';
        $vue = $root . '/app/view/viewAll.php';
        if (DEBUG) {
            echo("ControllerAdmin : doctorReadAll : vue = $vue");
        }
        require($vue);
    }

    public static function doctorNbPerPatient($args)
    {
        list($nbColumns, $columns, $results) = ModelUser::getNbPatientPerDoctor();
        // ----- Construction chemin de la vue
        include 'config.php';
        $title .= " | Administrateur";
        $slogan = "Nombre de patient par praticien (rendez-vous)";
        $vue = $root . '/app/view/viewAll.php';
        if (DEBUG) {
            echo("ControllerAdmin : userPerAddress : vue = $vue");
        }
        require($vue);
    }


}

?>
<!-- ----- fin ControllerUser -->


