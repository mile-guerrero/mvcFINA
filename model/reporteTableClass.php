<?php

use mvc\model\modelClass as model;
use mvc\config\configClass as config;

/**
 * Description of historialTableClass
 *
 * @author Gonzalo Andres Bejarano, Elcy Milena Guerrero, Andres Eduardo Bahamon
 */
class reporteTableClass extends reporteBaseTableClass {

  public static function getTotalPages($lines){
    try {
      $sql = 'SELECT count(' . reporteTableClass::ID . ') AS cantidad ' .
              ' FROM ' .reporteTableClass::getNameTable();
    
      
      $answer = model::getInstance()->prepare($sql);
      $answer->execute();
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);
      return ceil($answer[0]->cantidad/$lines);
    }  catch (PDOException $exc){
       throw  $exc;
  }}
  
}