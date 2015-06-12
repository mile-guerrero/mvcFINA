<?php

use mvc\model\modelClass as model;
use mvc\config\configClass as config;

/**
 * Description of credencialTableClass
 *
 * @author Andres Eduardo Bahamon, Elcy Milena Guerrero, Gonzalo Andres Bejarano
 */
class detalleFacturaVentaTableClass extends detalleFacturaVentaBaseTableClass {

  public static function getTotalPages($lines) {
    try {
      $sql = 'SELECT count(' . detalleFacturaVentaTableClass::ID . ') AS cantidad ' .
              ' FROM ' . detalleFacturaVentaTableClass::getNameTable();
              
      $answer = model::getInstance()->prepare($sql);
      $answer->execute();
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);
      return ceil($answer[0]->cantidad / $lines);
    } catch (PDOException $exc) {
      throw $exc;
    }
  }
  
  public static function getNameDetalleFactura($id){
    try {
      $sql = 'SELECT ' . detalleFacturaVentaTableClass::ID .  ' As id'
             . '  FROM ' . detalleFacturaVentaTableClass::getNameTable() . '  '
             . '  WHERE ' . detalleFacturaVentaTableClass::ID . ' = :id';
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
