<?php

use mvc\model\modelClass as model;
use mvc\config\configClass as config;

/**
 * Description of enfermedadTableClass
 *
 * @author Gonzalo Andres Bejarano, Elcy Milena Guerrero, Andres Eduardo Bahamon
 */

class enfermedadTableClass extends enfermedadBaseTableClass {
  public static function getTotalPages($lines){
    try {
      $sql = 'SELECT count(' . enfermedadTableClass::ID . ') AS cantidad ' .
              ' FROM ' .enfermedadTableClass::getNameTable() .
              ' WHERE '. enfermedadTableClass::DELETED_AT . ' IS NULL ';
      $answer = model::getInstance()->prepare($sql);
      $answer->execute();
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);
      return ceil($answer[0]->cantidad/$lines);
    }  catch (PDOException $exc){
       throw  $exc;
  }
  
    } 
   
  
}
