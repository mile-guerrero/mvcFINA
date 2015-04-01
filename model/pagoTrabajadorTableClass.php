<?php

use mvc\model\modelClass as model;
use mvc\config\configClass as config;

/**
 * Description of credencialTableClass
 *
 * @author Andres Eduardo Bahamon, Elcy Milena Guerrero, Gonzalo Andres Bejarano
 */
class pagoTrabajadorTableClass extends pagoTrabajadorBaseTableClass {
  
   public static function getNamePagoTrabajador($id){
    try {
      $sql = 'SELECT ' . pagoTrabajadorTableClass::ID .  ' As id  '
             . '  FROM ' . pagoTrabajadorTableClass::getNameTable() . '  '
             . '  WHERE ' . pagoTrabajadorTableClass::ID . ' = :id';
      $params = array(
          ':id'  => $id
      );
      $answer = model::getInstance()->prepare($sql);
      $answer->execute($params);
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);
      return $answer[0]->id;
      
    } catch (Exception $exc) {
      throw $exc;
    }
    
  }

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
