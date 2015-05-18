<?php

use mvc\model\modelClass as model;
use mvc\config\configClass as config;

/**
 * Description of ordenServicioTableClass
 *
 * @author Gonzalo Andres Bejarano, Elcy Milena Guerrero, Andres Eduardo Bahamon
 */
class ordenServicioTableClass extends ordenServicioBaseTableClass {
  public static function getTotalPages($lines) {
    try {
      $sql = 'SELECT count(' . ordenServicioTableClass::ID . ') AS cantidad ' .
              ' FROM ' . ordenServicioTableClass::getNameTable() ;
      $answer = model::getInstance()->prepare($sql);
      $answer->execute();
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);
      return ceil($answer[0]->cantidad / $lines);
    } catch (PDOException $exc) {
      throw $exc;
    }
  }
}
