<?php

use mvc\model\modelClass as model;
use mvc\config\configClass as config;

/**
 * Description of credencialTableClass
 *
 * @author Andres Eduardo Bahamon, Elcy Milena Guerrero, Gonzalo Andres Bejarano
 */
class facturaCompraTableClass extends facturaCompraBaseTableClass {
    
    public static function getNameFactura($id){
    try {
      $sql = 'SELECT ' . facturaCompraTableClass::ID .  ' As id'
             . '  FROM ' . facturaCompraTableClass::getNameTable() . '  '
             . '  WHERE ' . facturaCompraTableClass::ID . ' = :id';
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

   public static function getTotalPages($lines, $where) {
    try {
      $sql = 'SELECT count(' . facturaCompraTableClass::ID . ') AS cantidad ' .
              ' FROM ' . facturaCompraTableClass::getNameTable();
      
          
      $answer = model::getInstance()->prepare($sql);
      $answer->execute();
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);
      return ceil($answer[0]->cantidad / $lines);
    } catch (PDOException $exc) {
      throw $exc;
    }
  }

}
