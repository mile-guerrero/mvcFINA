<?php

use mvc\model\modelClass as model;
use mvc\config\configClass as config;

/**
 * Description of credencialTableClass
 *
 * @author Andres Eduardo Bahamon, Elcy Milena Guerrero, Gonzalo Andres Bejarano
 */
class detalleFacturaCompraTableClass extends detalleFacturaCompraBaseTableClass {

  public static function getTotalPages($lines) {
    try {
      $sql = 'SELECT count(' . detalleFacturaCompraTableClass::ID . ') AS cantidad ' .
              ' FROM ' . detalleFacturaCompraTableClass::getNameTable();
              
      $answer = model::getInstance()->prepare($sql);
      $answer->execute();
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);
      return ceil($answer[0]->cantidad / $lines);
    } catch (PDOException $exc) {
      throw $exc;
    }
  }
  
  public static function getNameDetalleFacturaCompra($id){
    try {
      $sql = 'SELECT ' . detalleFacturaCompraTableClass::ID .  ' As id'
             . '  FROM ' . detalleFacturaCompraTableClass::getNameTable() . '  '
             . '  WHERE ' . detalleFacturaCompraTableClass::ID . ' = :id';
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

}
