<?php

use mvc\model\modelClass as model;
use mvc\config\configClass as config;

/**
 * Description of credencialTableClass
 *
 * @author Andres Eduardo Bahamon, Elcy Milena Guerrero, Gonzalo Andres Bejarano
 */
class detallePagoTrabajadorTableClass extends detallePagoTrabajadorBaseTableClass {
  
  public static function getNameDetallePagoTrabajador($id){
    try {
      $sql = 'SELECT ' . detallePagoTrabajadorTableClass::PAGO_TRABAJADOR_ID .  ' As pago  '
             . '  FROM ' . detallePagoTrabajadorTableClass::getNameTable() . '  '
             . '  WHERE ' . detallePagoTrabajadorTableClass::ID . ' = :id';
      $params = array(
          ':id' => $id
      );
      $answer = model::getInstance()->prepare($sql);
      $answer->execute($params);
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);
      return $answer[0]->pago;
      
    } catch (Exception $exc) {
      throw $exc;
    }
    
  }

  public static function getTotalPages($lines) {
    try {
      $sql = 'SELECT count(' . detallePagoTrabajadorTableClass::ID . ') AS cantidad ' .
              ' FROM ' . detallePagoTrabajadorTableClass::getNameTable();
              
      $answer = model::getInstance()->prepare($sql);
      $answer->execute();
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);
      return ceil($answer[0]->cantidad / $lines);
    } catch (PDOException $exc) {
      throw $exc;
    }
  }

}
