<?php

use mvc\model\modelClass as model;
use mvc\config\configClass as config;

/**
 * Description of laborTableClass
 *
 * @author Gonzalo Andres Bejarano, Elcy Milena Guerrero, Andres Eduardo Bahamon
 */

class laborTableClass extends laborBaseTableClass {
  public static function getTotalPages($lines){
    try {
      $sql = 'SELECT count(' . laborTableClass::ID . ') AS cantidad ' .
              ' FROM ' .laborTableClass::getNameTable() ;
      $answer = model::getInstance()->prepare($sql);
      $answer->execute();
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);
      return ceil($answer[0]->cantidad/$lines);
    }  catch (PDOException $exc){
       throw  $exc;
  }}
}
