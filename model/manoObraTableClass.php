<?php
use mvc\model\modelClass as model;
use mvc\config\configClass as config;

/**
 * Description of manoObraTableClass
 *
 * @author Andres Eduardo Bahamon, Elcy Milena Guerrero, Gonzalo Andres Bejarano
 */
class manoObraTableClass extends manoObraBaseTableClass {
public static function getTotalPages($lines) {
    try {
      $sql = 'SELECT count(' . manoObraTableClass::ID . ') AS cantidad ' .
              ' FROM ' . manoObraTableClass::getNameTable() .
              ' WHERE ' . manoObraTableClass::DELETED_AT . ' IS NULL ';
      $answer = model::getInstance()->prepare($sql);
      $answer->execute();
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);
      return ceil($answer[0]->cantidad / $lines);
    } catch (PDOException $exc) {
      throw $exc;
    }
  }
}
