<?php

use mvc\model\modelClass as model;
use mvc\config\configClass as config;

/**
 * Description of solicitudInsumoTableClass
 *
 * @author Gonzalo Andres Bejarano, Elcy Milena Guerrero, Andres Eduardo Bahamon
 */
class solicitudInsumoTableClass extends solicitudInsumoBaseTableClass {
  
  public static function getTotalPages($lines){
    try {
      $sql = 'SELECT count(' . solicitudInsumoTableClass::ID . ') AS cantidad ' .
              ' FROM ' .solicitudInsumoTableClass::getNameTable() .
              ' WHERE '. solicitudInsumoTableClass::DELETED_AT . ' IS NULL ';
      $answer = model::getInstance()->prepare($sql);
      $answer->execute();
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);
      return ceil($answer[0]->cantidad/$lines);
    }  catch (PDOException $exc){
       throw  $exc;
  }
}
}
