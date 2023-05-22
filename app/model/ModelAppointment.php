<?php
require_once 'Model.php';
class ModelAppointment
{
    private $id, $patient_id, $doctor_id, $appt_date;

    /**
     * @param $id
     * @param $patient_id
     * @param $doctor_id
     * @param $appt_date
     */
    public function __construct($id, $patient_id, $doctor_id, $appt_date)
    {
        $this->id = $id;
        $this->patient_id = $patient_id;
        $this->doctor_id = $doctor_id;
        $this->appt_date = $appt_date;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    
    public function getPatientId()
    {
        return $this->patient_id;
    }

    public function setPatientId($patient_id)
    {
        $this->patient_id = $patient_id;
    }

    
    public function getDoctorId()
    {
        return $this->doctor_id;
    }

    public function setDoctorId($doctor_id)
    {
        $this->doctor_id = $doctor_id;
    }

    
    public function getApptDate()
    {
        return $this->appt_date;
    }

    public function setApptDate($appt_date)
    {
        $this->appt_date = $appt_date;
    }

    public static function getAll()
    {
        $query = "select 
                    patient_id,
                    p.lastname as patient_nom, 
                    p.firstname as patient_prenom, 
                    doctor_id as praticien_id,
                    d.lastname as praticien_nom, 
                    d.firstname as praticien_prenom,
                    a.appt_date as date
                 from appointment a, user p, user d 
                 where patient_id != 0 
                   and p.id = a.patient_id 
                   and d.id = a.doctor_id";
        return Model::getWithColumns($query);
    }


    public static function getDoctorFreeAppt($id)
    {
        try {
            $database = Model::getInstance();
            $query = "select appt_date as 'disponibilité' from appointment where doctor_id = :id and patient_id = 0";
            $statement = $database->prepare($query);
            $statement->execute(['id' => $id]);
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return null;
        }
    }

    public static function insertMultipleFree($appointments)
    {
        try {
            $database = Model::getInstance();
            $query = "select count(*) from appointment where doctor_id = :id and appt_date like :date";
            $statement = $database->prepare($query);
            $statement->execute(['id' => $appointments['id'], 'date' => $appointments['appt_date'].'%']);
            $nbRow = $statement->fetch(PDO::FETCH_NUM)[0];
            if (($appointments['max'] - $nbRow) <= 0 ) {
                return [3, "Vous ne pouvez plus rajouter de créneaux sur ce jour"];
            } else {
                $query = "select max(id) from appointment";
                $statement = $database->prepare($query);
                $statement->execute();
                $id = $statement->fetch(PDO::FETCH_NUM)[0] + 1;
                $query = "insert into appointment(id, patient_id, doctor_id, appt_date) values ";
                $value_pattern = "(:id_%d, 0, :doctor_id_%d, :appt_date_%d), ";
                $date_pattern = '%s à 1%dh00';
                $start = $nbRow;
                if (($appointments['max'] - $nbRow) < $appointments['hours']) {
                    $max = $appointments['max'];
                    $result = [2, sprintf("Seulement %d nouveaux créneaux ont été ajouté sur les %d demandé, le nombre de créneau est complet sur ce jour",
                      $appointments['max'] - $nbRow, $appointments['hours']
                    )];
                } else {
                    $max = $appointments['hours'] + $start;
                    $result = [1, "Les créneaux demandés ont bien été ajoutés"];
                }
                $execute = [];
                for ($i=$start; $i<$max; $i++) {
                    $execute["id_".$i] = $id + $i;
                    $execute["doctor_id_".$i] = $appointments['id'];
                    $execute["appt_date_".$i] = sprintf($date_pattern, $appointments['appt_date'], $i);
                    $query .= sprintf($value_pattern, $i,$i,$i);
                }
                $query = rtrim($query, ', ');
                $statement = $database->prepare($query);
                $statement->execute($execute);
                return $result;
            }

        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return -1;
        }
    }

    public static function getAppointmentsWithPatient($id)
    {
        $query = "select p.firstname, p.lastname, appt_date 
from user p, user d, appointment a 
where a.doctor_id = d.id 
  and a.patient_id = p.id
  and p.id != 0
  and d.id = $id";
        return Model::getWithColumns($query);
    }

    public static function getAppointmentsWithDoctor($id)
    {
        $query = "select d.firstname, d.lastname, d.address, appt_date 
from user p, user d, appointment a 
where a.doctor_id = d.id 
  and a.patient_id = p.id
  and p.id = $id order by appt_date asc";
        return Model::getWithColumns($query);
    }

    public static function getDistinctPatientList($id)
    {
        $query = "select p.firstname, p.lastname, p.address 
from user p, user d, appointment a 
where a.doctor_id = d.id 
  and a.patient_id = p.id
  and p.id != 0
  and d.id = $id
  group by p.id";
        return Model::getWithColumns($query);
    }

    public static function update($entity)
    {
        try {
            $database = Model::getInstance();
            $query = "update appointment set patient_id = :patient_id where doctor_id = :doctor_id and appt_date = :appt";
            $statement = $database->prepare($query);
            $statement->execute(['doctor_id' => $entity['doctor_id'], 'patient_id' => $entity['patient_id'], 'appt' => $entity['appt']]);
            return 1;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return null;
        }
    }

}