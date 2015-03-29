<?php

use mvc\model\modelClass as model;
use mvc\config\configClass as config;

/**
 * Description of credencialTableClass
 *
 * @author Gonzalo Andres Bejarano, Elcy Milena Guerrero, Andres Eduardo Bahamon
 */
class credencialTableClass extends credencialBaseTableClass {
  
  public static function getTotalPages($lines){
    try {
      $sql = 'SELECT count(' . credencialTableClass::ID . ') AS cantidad ' .
              ' FROM ' .credencialTableClass::getNameTable() .
              ' WHERE '. credencialTableClass::DELETED_AT . ' IS NULL ';
      $answer = model::getInstance()->prepare($sql);
      $answer->execute();
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);
      return ceil($answer[0]->cantidad/$lines);
    }  catch (PDOException $exc){
       throw  $exc;
  }}
  
public static function getNameCredencial($id){
    try {
      $sql = 'SELECT ' . credencialTableClass::NOMBRE.  ' As nombre  '
             . '  FROM ' . credencialTableClass::getNameTable() . '  '
             . '  WHERE ' . credencialTableClass::ID . ' = :id';
      $params = array(
          ':id' => $id
      );
      $answer = model::getInstance()->prepare($sql);
      $answer->execute($params);
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);
      return $answer[0]->nombre;
      
    } catch (Exception $exc) {
      throw $exc;
    }
    
  }
}
