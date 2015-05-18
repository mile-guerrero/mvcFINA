<?php

use mvc\model\modelClass as model;
use mvc\config\configClass as config;

/**
 * Description of pedidoTableClass
 *
 * @author Andres Eduardo Bahamon, Elcy Milena Guerrero, Gonzalo Andres Bejarano
 */
class pedidoTableClass extends pedidoBaseTableClass {
  public static function getTotalPages($lines) {
    try {
      $sql = 'SELECT count(' . pedidoTableClass::ID . ') AS cantidad ' .
              ' FROM ' . pedidoTableClass::getNameTable() .
              ' WHERE ' . pedidoTableClass::DELETED_AT . ' IS NULL ';
      $answer = model::getInstance()->prepare($sql);
      $answer->execute();
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);
      return ceil($answer[0]->cantidad / $lines);
    } catch (PDOException $exc) {
      throw $exc;
    }
  }
}
