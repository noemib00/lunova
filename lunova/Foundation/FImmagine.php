<?php

/**
 * in FUtente e Fdisco mettere il riferimento id dell'immagine nei values (bind)
 * Class FImmagine
 */

class FImmagine
{
    private static $class = "FImmagine";

    private static $table = "immagine";

    private static $values = "(:Id,:Nome,:Formato,:Byte)";

    public function __construct(){}

    /**
     * @param $statement
     * @param EImmagine $immagine
     * @param $foreignkey
     */
    public static function bind($statement, EImmagine $immagine, $foreignkey){
        $statement->bindValue(':Id',$immagine->getId(), PDO::PARAM_STR);
        $statement->bindValue(':Nome',$immagine->getNome(), PDO::PARAM_STR);
        $statement->bindValue(':Formato',$immagine->getFormato(), PDO::PARAM_STR);
        $statement->bindValue(':Byte',$immagine->getByte(), PDO::PARAM_STR);
        if($foreignkey["idartista"]!=null){
            $statement->bindValue(':IdArtista',$foreignkey["idartista"], PDO::PARAM_STR);
        }else{
            $statement->bindValue(':IdArtista',null, PDO::PARAM_STR);
        }
        if($foreignkey["idcategoria"]!=null){
            $statement->bindValue(':RIdCategoria',$foreignkey["idcategoria"],PDO::PARAM_STR);
        }else{
            $statement->bindValue(':RIdCategoria',null,PDO::PARAM_STR);
        }

    }

    /**
     * @param $immagine
     * @param $foreignkey
     */
    public static function storeImmagine($immagine,$foreignkey){
        $pers = FPersistentManager::getInstance();
        $query = "INSERT INTO " . FImmagine::getTable() . " VALUES " . FImmagine::getValues();
        $pers->connection->db->quote($query);
        $queryready = $pers->connection->db->prepare($query);
        FImmagine::bind($queryready, $immagine, $foreignkey);
        $queryready->execute();
    }

    /**
     * @param $etichetta
     * @param $nome
     * @return mixed
     */
    public static function existImmagine ($etichetta,$nome){
        $connection = FPersistentManager::getInstance();
        $ris = $connection->exist(static::getClass(),$etichetta,$nome);
        return $ris;
    }

    /**
     * @param $etichetta
     * @param $nome
     * @return bool
     */
    public static function deleteImmagine ($etichetta,$nome){
        $connection = FPersistentManager::getInstance();
        $ris = $connection->delete(static::getClass(),$etichetta,$nome);
        return $ris;
    }

    /**
     * @param $etichetta
     * @param $id
     * @return EImmagine
     * @throws Exception
     */
    public static function prelevaImmagine($etichetta,$id){
        $pers = FPersistentManager::getInstance();
        $query = "SELECT * FROM " . FImmagine::getTable() . " WHERE " . $etichetta . "='" . $id . "';";
        $pers->connection->db->quote($query);
        $queryready = $pers->connection->db->prepare($query);
        $queryready->execute();
        $result = $queryready->fetch(PDO::FETCH_ASSOC);
        $immagine = new EImmagine($result["Nome"],$result["Byte"],$result["Formato"]);
        return $immagine;
    }

    /**
     * @return string
     */
    public static function getClass(): string
    {
        return self::$class;
    }

    /**
     * @return string
     */
    public static function getTable(): string
    {
        return self::$table;
    }

    /**
     * @return string
     */
    public static function getValues(): string
    {
        return self::$values;
    }



}