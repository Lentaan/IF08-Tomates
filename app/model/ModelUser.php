<!-- ----- debut ModelUser -->

<?php
require_once 'Model.php';

class ModelUser
{
    private $id, $lastname, $firstname, $address, $login, $password, $status, $speciality_id;

    const ADMIN = 0;
    const DOCTOR = 1;
    const PATIENT = 2;
    const INSERT = ':id, :lastname, :firstname, :address, :login, :password, :status, :speciality_id';

    public static function getNameRoles()
    {
        return ['admin' => self::ADMIN, 'doctor' => self::DOCTOR, 'patient' => self::PATIENT, ];
    }

    public function __toString()
    {
        return implode(" : ", Model::dehydrate(['login', 'lastname', 'firstname', 'address', 'status', 'speciality_id'], $this));
    }
    public function __construct($user)
    {
        // valeurs nulles si pas de passage de parametres
        Model::hydrate($user, $this);
    }

    public static function getNamedStatus($status) {
        switch($status) {
            case self::ADMIN :
                return'Administrateur';
            case self::DOCTOR :
                return 'Praticien';
            case self::PATIENT :
                return 'Patient';
        };
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }

    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * @param mixed $login
     */
    public function setLogin($login)
    {
        $this->login = $login;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @param mixed $speciality_id
     */
    public function setSpecialityId($speciality_id)
    {
        $this->speciality_id = $speciality_id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getLastname()
    {
        return $this->lastname;
    }

    public function getFirstname()
    {
        return $this->firstname;
    }

    public function getAddress()
    {
        return $this->address;
    }

    
    public function getLogin()
    {
        return $this->login;
    }

    
    public function getPassword()
    {
        return $this->password;
    }

    
    public function getStatus()
    {
        return $this->status;
    }

    
    public function getSpecialityId()
    {
        return $this->speciality_id;
    }

// retourne une liste des id
    public static function getAllId()
    {
        try {
            $database = Model::getInstance();
            $query = "select id from user";
            $statement = $database->prepare($query);
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_COLUMN, 0);
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return null;
        }
    }

    public static function getMany($query)
    {
        try {
            $database = Model::getInstance();
            $statement = $database->prepare($query);
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelUser");
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return null;
        }
    }

    public static function getAllDoctor()
    {
        $query = "select user.id, firstname, lastname, address, speciality.label as speciality from user, speciality where status = 1 and speciality_id = speciality.id";
        return Model::getWithColumns($query);
    }

    public static function getAllDoctorInfo()
    {
        $query = "select * from user where status = 1";
        return Model::getWithColumns($query);
    }
    public static function getAllPatient()
    {
        $query = "select * from user where status = 2 and id != 0";
        return Model::getWithColumns($query);
    }
    public static function getAllAdmin()
    {
        $query = "select * from user where status = 0";
        return Model::getWithColumns($query);
    }

    public static function getNbPatientPerDoctor()
    {
        $query = "select u2.firstname, u2.lastname, count(u1.id) as number 
from user u1, user u2, appointment appt 
where appt.patient_id = u1.id 
  and appt.doctor_id = u2.id 
  and u1.id != 0 
group by u2.id;";
        return Model::getWithColumns($query);
    }

    public static function getUserPerAddress()
    {
        try {
            $database = Model::getInstance();
            $query = "select address, count(*) from user group by address";
            $statement = $database->prepare($query);
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_KEY_PAIR);
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return null;
        }
    }

    public static function getOne($id)
    {
        try {
            $query = "select * from user where id = $id";
            return Model::getWithColumns($query);
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return null;
        }
    }

    public static function insert($user)
    {
        try {
            $database = Model::getInstance();

            $query = "select max(id) from user";
            $statement = $database->query($query);
            $tuple = $statement->fetch();
            $id = $tuple['0'];
            $user['id'] = $id + 1;

            $query = sprintf("insert into user value (%s)", self::INSERT);
            $statement = $database->prepare($query);
            $statement->execute($user);
            return $id;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return -1;
        }
    }

    public static function update()
    {
        echo("ModelUser : update() TODO ....");
        return null;
    }

    public static function deleteOne($id)
    {
        try {
            $database = Model::getInstance();
            $query = "delete from user where id = :id";
            $statement = $database->prepare($query);
            $statement->execute(['id' => $id]);
            return 'a été supprimer';
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return -1;
        }
    }

    public static function login($user)
    {
        try {
            $database = Model::getInstance();
            $query = "select id, lastname, firstname, login, status from user where login = :login and password = :password";
            $statement = $database->prepare($query);
            $statement->execute(['login' => $user->login, 'password' => $user->password]);
            return $statement->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return -1;
        }
    }

    public static function getMostAskedDoctor()
    {
        $query = "select u2.firstname, u2.lastname, count(u1.id) as number 
from user u1, user u2, appointment appt 
where appt.patient_id = u1.id 
  and appt.doctor_id = u2.id 
  and u1.id != 0 
group by u2.id order by number DESC limit 3";
        return Model::getWithColumns($query);
    }

    public static function getMostFreeDoctor()
    {
        $query = "select u2.firstname, u2.lastname, count(appt.id) as number
from user u1, user u2, appointment appt 
where appt.patient_id = u1.id 
  and appt.doctor_id = u2.id 
  and u1.id = 0 
group by u2.id order by number DESC limit 3";
        return Model::getWithColumns($query);
    }

    public static function getMostPopularDoctorAddress()
    {
        $query = "select address, count(id) as number from user where status = 1 group by address order by number DESC limit 3";
        return Model::getWithColumns($query);
    }

    public static function getMostPopularSpeciality()
    {
        $query = "select speciality.label, count(user.id) as number from user, speciality where status = 1 and speciality.id = user.speciality_id group by speciality_id order by number DESC limit 3";
        return Model::getWithColumns($query);
    }

    public static function getMostAskedDoctorByAddressAndSpeciality($address, $speciality)
    {
        $query = "select u2.firstname, u2.lastname, count(u1.id) as number 
from user u1, user u2, appointment appt 
where appt.patient_id = u1.id 
  and appt.doctor_id = u2.id 
  and u1.id != 0 
  and u2.address = :address
  and u2.speciality_id = :speciality   
group by u2.id order by number DESC limit 3";
        try {
            $database = Model::getInstance();
            $statement = $database->prepare($query);
            $statement->execute(['address' => $address, 'speciality' => $speciality]);
            $nbColumns = $statement->columnCount();
            $columns = [];
            for ($i=0;$i<$nbColumns;$i++){
                $columns[] = $statement->getColumnMeta($i)['name'];
            }
            return array($columns,$statement->fetchAll(PDO::FETCH_ASSOC));
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return null;
        }
    }

    public static function getNearbyDoctor($id)
    {
        $query = "select u2.firstname, u2.lastname, u1.address, speciality.label as number 
from user u1, user u2, speciality 
where u2.status = 1 
    and u1.status = 2
    and u1.id = $id
    and u2.address LIKE '%' + u1.address + '%'
limit 5";
        return Model::getWithColumns($query);
    }

}

?>
<!-- ----- fin ModelUser -->
