<?php

use mvc\model\modelClass as model;
use mvc\config\configClass as config;

/**
 * Description of cooperativaTableClass
 *
 * @author Gonzalo Andres Bejarano, Elcy Milena Guerrero, Andres Eduardo Bahamon
 */

class cooperativaTableClass extends cooperativaBaseTableClass {
  public static function getTotalPages($lines){
    try {
      $sql = 'SELECT count(' . cooperativaTableClass::ID . ') AS cantidad ' .
              ' FROM ' . cooperativaTableClass::getNameTable() .
              ' WHERE '. cooperativaTableClass::DELETED_AT . ' IS NULL ';
      $answer = model::getInstance()->prepare($sql);
      $answer->execute();
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);
      return ceil($answer[0]->cantidad/$lines);
    }  catch (PDOException $exc){
       throw  $exc;
      
    } catch (PDOException $exc) {
      throw $exc;
    }
  }
  
   
  
}
