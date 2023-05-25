<!-- ----- debut Model -->
<?php

class Model extends PDO
{

    private static $_instance;

    // Constructeur : héritage public obligatoire par héritage de PDO
    public function __construct()
    {
    }

    public static function processChars($val)
    {
        return htmlspecialchars($val);
    }

    public static function snakeToCamel($string)
    {
        $string = str_replace('_', ' ', $string);
        $string = ucwords($string);
        $string = str_replace(' ', '', $string);
        if (DEBUG) {
            echo("Model : snakeToCamel : string = $string</br>");
        }
        return lcfirst($string);
    }
    
    public static function dehydrate($columns, $object) {
        if (DEBUG) {
            printf("Model : dehydrate : columns = %s , object = %s</br>", print_r($columns, true), print_r($object, true));
        }
        $result = [];
        foreach ($columns as $column) {
            $method = self::snakeToCamel('get_' . $column);
            if (property_exists($object, $column) && method_exists($object, $method)) {
                $result[$column] = $object->$method();
            }
        }

        return $result;
    }

    public static function getWithColumns($query) {
        try {
            $database = self::getInstance();
            $statement = $database->prepare($query);
            $statement->execute();
            $nbColumns = $statement->columnCount();
            $columns = [];
            for ($i=0;$i<$nbColumns;$i++){
                $columns[] = $statement->getColumnMeta($i)['name'];
            }
            return array($nbColumns, $columns,$statement->fetchAll(PDO::FETCH_ASSOC));
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return null;
        }
    }
    
    public static function hydrate($data, $object)
    {
        if (DEBUG) {
            printf("Model : hydrate : data = %s , object = %s</br>", print_r($data, true), print_r($object, true));
        }
        foreach ($data as $key => $value) {
            $method = self::snakeToCamel('set_' . $key);
            if (property_exists($object, $key) && method_exists($object, $method)) {
                $object->$method($value);
            }
        }

        return $object;
    }

    //Singleton
    public static function getInstance()
    {
        // les variables sont définies dans le fichier config.php
        include CONTROLLER_DIR . 'config.php';

        if (DEBUG) {
            echo("Model : getInstance : dsn = $dsn</br>");
        }

        $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

        if (!isset(self::$_instance)) {
            try {
                self::$_instance = new PDO($dsn, $username, $password, $options);
            } catch (PDOException $e) {
                printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            }
        }
        return self::$_instance;
    }

}

?>
<!-- ----- fin Model -->
