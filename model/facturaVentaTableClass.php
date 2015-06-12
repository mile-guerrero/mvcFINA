<?php

use mvc\model\modelClass as model;
use mvc\config\configClass as config;

/**
 * Description of credencialTableClass
 *
 * @author Andres Eduardo Bahamon, Elcy Milena Guerrero, Gonzalo Andres Bejarano
 */
class facturaVentaTableClass extends facturaVentaBaseTableClass {
    
    public static function getNameFactura($id){
    try {
      $sql = 'SELECT ' . facturaVentaTableClass::ID .  ' As id'
             . '  FROM ' . facturaVentaTableClass::getNameTable() . '  '
             . '  WHERE ' . facturaVentaTableClass::ID . ' = :id';
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
      $sql = 'SELECT count(' . facturaVentaTableClass::ID . ') AS cantidad ' .
              ' FROM ' . facturaVentaTableClass::getNameTable();
              
      $answer = model::getInstance()->prepare($sql);
      $answer->execute();
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);
      return ceil($answer[0]->cantidad / $lines);
    } catch (PDOException $exc) {
      throw $exc;
    }
  }

}
