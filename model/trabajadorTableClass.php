<?php

use mvc\model\modelClass as model;
use mvc\config\configClass as config;

/**
 * Description of credencialTableClass
 *
 * @author gonzalo bejarano
 */
class trabajadorTableClass extends trabajadorBaseTableClass {
  
  public static function getNameTrabajador($id){
    try {
      $sql = 'SELECT ' . trabajadorTableClass::NOMBRET .  ' As nombre  '
             . '  FROM ' . trabajadorTableClass::getNameTable() . '  '
             . '  WHERE ' . trabajadorTableClass::ID . ' = :id';
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

  public static function getTotalPages($lines) {
    try {
      $sql = 'SELECT count(' . trabajadorTableClass::ID . ') AS cantidad ' .
              ' FROM ' . trabajadorTableClass::getNameTable() .
              ' WHERE ' . trabajadorTableClass::DELETED_AT . ' IS NULL ';
      $answer = model::getInstance()->prepare($sql);
      $answer->execute();
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);
      return ceil($answer[0]->cantidad / $lines);
    } catch (PDOException $exc) {
      throw $exc;
    }
  }

}
