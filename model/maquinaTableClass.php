<?php

use mvc\model\modelClass as model;
use mvc\config\configClass as config;

/**
 * Description of maquinaTableClass
 *
 * @author Gonzalo Andres Bejarano, Elcy Milena Guerrero, Andres Eduardo Bahamon
 */
class maquinaTableClass extends maquinaBaseTableClass {

  public static function getTotalPages($lines){
    try {
      $sql = 'SELECT count(' . maquinaTableClass::ID . ') AS cantidad ' .
              ' FROM ' . maquinaTableClass::getNameTable() .
              ' WHERE '. maquinaTableClass::DELETED_AT . ' IS NULL ';
      $answer = model::getInstance()->prepare($sql);
      $answer->execute();
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);
      return ceil($answer[0]->cantidad/$lines);
    }  catch (PDOException $exc){
       throw  $exc;
  }}  
  
  public static function getNameMaquina($id) {
        try {
            $sql = 'SELECT ' . maquinaTableClass::NOMBRE . ' As descripcion  '
                    . '  FROM ' . maquinaTableClass::getNameTable() . '  '
                    . '  WHERE ' . maquinaTableClass::ID . ' = :id';
            $params = array(
                ':id' => $id
            );
            $answer = model::getInstance()->prepare($sql);
            $answer->execute($params);
            $answer = $answer->fetchAll(PDO::FETCH_OBJ);
            return $answer[0]->descripcion;
        } catch (Exception $exc) {
            throw $exc;
        }
    }

}
