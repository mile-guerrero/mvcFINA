<?php

use mvc\model\modelClass as model;
use mvc\config\configClass as config;

/**
 * Description of credencialTableClass
 *
 * @author Andres Eduardo Bahamon, Elcy Milena Guerrero, Gonzalo Andres Bejarano
 */
class pagoTrabajadorTableClass extends pagoTrabajadorBaseTableClass {

  public static function getTotalPages($lines) {
    try {
      $sql = 'SELECT count(' . pagoTrabajadorTableClass::ID . ') AS cantidad ' .
              ' FROM ' . pagoTrabajadorTableClass::getNameTable();
              
      $answer = model::getInstance()->prepare($sql);
      $answer->execute();
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);
      return ceil($answer[0]->cantidad / $lines);
    } catch (PDOException $exc) {
      throw $exc;
    }
  }

}
