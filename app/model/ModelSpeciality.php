<?php

require_once 'Model.php';

class ModelSpeciality
{
    private $id, $label;

    public function __construct($id, $label) {
        if (!is_null($id)) {
            Model::hydrate([$id, $label], $this);
        }
    }

    public static function getAll()
    {
        $query = "select * from speciality";
        return Model::getWithColumns($query);
    }

    public static function getAllId()
    {
        try {
            $database = Model::getInstance();
            $query = "select id from speciality";
            $statement = $database->prepare($query);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_COLUMN, 0);
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return null;
        }
    }

    public static function getOne($speciality_id)
    {
        try {
            $database = Model::getInstance();
            $query = "select * from speciality where id = :id";
            $statement = $database->prepare($query);
            $statement->execute([
              'id' => $speciality_id
            ]);
            return array(2, ['id', 'label'], $statement->fetchAll(PDO::FETCH_ASSOC));
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return null;
        }
    }

    public static function insert($speciality)
    {
        try {
            $database = Model::getInstance();
            $query = "select max(id) from speciality";
            $statement = $database->query($query);
            $tuple = $statement->fetch();
            $id = $tuple['0'];
            $speciality['id'] = $id + 1;

            $query = "insert into speciality value (:id, :label)";
            $statement = $database->prepare($query);
            $statement->execute($speciality);
            return $id;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return -1;
        }
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @param mixed $label
     */
    public function setLabel($label)
    {
        $this->label = $label;
    }


}