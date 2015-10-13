<?php

use mvc\model\modelClass as model;
use mvc\config\configClass as config;
use mvc\session\sessionClass as session;
/**
 * Description of pagoTrabajadorTableClass
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
  
  
  public static function getTotal($idTrabajador){
    try {
      $sql = 'SELECT ' . '  '. 'SUM ('. pagoTrabajadorTableClass::TOTAL_PAGAR  . ') ' .  ' As total'
             . '  FROM ' . pagoTrabajadorTableClass::getNameTable() . '  ' 
             . ' WHERE ' . pagoTrabajadorTableClass::TRABAJADOR_ID . ' = ' . $idTrabajador;
    
      $answer = model::getInstance()->prepare($sql);
            $answer->execute();
            $answer = $answer->fetchAll(PDO::FETCH_OBJ);
 return $answer[0]->total;
   } catch (Exception $exc) {
      throw $exc;
    }
    
  }
  
  
  public static function getTotalJaja($idTrabajador,$fechaInicial,$fechaFin){
    try {
      $fechaFin = session::getInstance()->getAttribute('TrabajadorFechaFin');
     
      $sql = 'SELECT ' . '  '. 'SUM ('. pagoTrabajadorTableClass::TOTAL_PAGAR  . ') ' .  ' As total'
             . '  FROM ' . pagoTrabajadorTableClass::getNameTable() . '  ' 
             . ' WHERE ' . '(' . pagoTrabajadorTableClass::getNameField(pagoTrabajadorTableClass::TRABAJADOR_ID) . ' = ' . $idTrabajador . ' ) '
                    . ' AND ' . '(' . pagoTrabajadorTableClass::getNameField(pagoTrabajadorTableClass::FECHA_INICIAL) . ' BETWEEN ' . "'" . date(config::getFormatTimestamp(), strtotime($fechaInicial . ' 00:00:00')) . "'" . ' AND ' . "'" . date(config::getFormatTimestamp(), strtotime($fechaFin . ' 23:59:59')) . "'" . ' ) ';
          
//     print_r($sql);
//            exit();
      $answer = model::getInstance()->prepare($sql);
            $answer->execute();
            $answer = $answer->fetchAll(PDO::FETCH_OBJ);
 return $answer[0]->total;
   } catch (Exception $exc) {
      throw $exc;
    }
    
  }
  
  public static function getTotalHistoria1(){
    try {
      $fechaInicial = session::getInstance()->getAttribute('fecha1');
      $fechaFin = session::getInstance()->getAttribute('fecha2');
     
      $sql = 'SELECT ' . '  '. 'SUM ('. pagoTrabajadorTableClass::TOTAL_PAGAR  . ') ' .  ' As total'
             . '  FROM ' . pagoTrabajadorTableClass::getNameTable() . '  ' 
             . ' WHERE ' . '(' . pagoTrabajadorTableClass::getNameField(pagoTrabajadorTableClass::FECHA_INICIAL) . ' BETWEEN ' . "'" . date(config::getFormatTimestamp(), strtotime($fechaInicial . ' 00:00:00')) . "'" . ' AND ' . "'" . date(config::getFormatTimestamp(), strtotime($fechaFin . ' 23:59:59')) . "'" . ' ) ';
          
//     print_r($sql);
//            exit();
      $answer = model::getInstance()->prepare($sql);
            $answer->execute();
            $answer = $answer->fetchAll(PDO::FETCH_OBJ);
 return $answer[0]->total;
   } catch (Exception $exc) {
      throw $exc;
    }
    
  }
  public static function getTotalHistoria2(){
    try {
      $fechaInicial = session::getInstance()->getAttribute('fecha3');
      $fechaFin = session::getInstance()->getAttribute('fecha4');
     
      $sql = 'SELECT ' . '  '. 'SUM ('. pagoTrabajadorTableClass::TOTAL_PAGAR  . ') ' .  ' As total'
             . '  FROM ' . pagoTrabajadorTableClass::getNameTable() . '  ' 
             . ' WHERE ' . '(' . pagoTrabajadorTableClass::getNameField(pagoTrabajadorTableClass::FECHA_INICIAL) . ' BETWEEN ' . "'" . date(config::getFormatTimestamp(), strtotime($fechaInicial . ' 00:00:00')) . "'" . ' AND ' . "'" . date(config::getFormatTimestamp(), strtotime($fechaFin . ' 23:59:59')) . "'" . ' ) ';
          
//     print_r($sql);
//            exit();
      $answer = model::getInstance()->prepare($sql);
            $answer->execute();
            $answer = $answer->fetchAll(PDO::FETCH_OBJ);
 return $answer[0]->total;
   } catch (Exception $exc) {
      throw $exc;
    }
    
  }


  public static function getTotalPages($lines, $where) {
    try {
      $sql = 'SELECT count(' . pagoTrabajadorTableClass::ID . ') AS cantidad ' .
              ' FROM ' . pagoTrabajadorTableClass::getNameTable();
              
      if (is_array($where) === true){
          foreach ($where as $field => $value){
              if (is_array($value)){
                  $sql = $sql . ' WHERE ' . $field . ' BETWEEN ' . ((is_numeric($value[0])) ? $value[0] : "'$value[0]'") . ' AND ' . ((is_numeric($value[1]) ? $value[1] : "'$value[1]'"));
              }  if(is_numeric($field)) {
                  $sql = $sql . ' WHERE ' . $value;
              } else {
                  $sql = $sql . ' WHERE ' . $field . ' = ' . ((is_numeric($value)) ? $value : "'$value'");
              }
          }
      }
      
      $answer = model::getInstance()->prepare($sql);
      $answer->execute();
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);
      return ceil($answer[0]->cantidad / $lines);
    } catch (PDOException $exc) {
      throw $exc;
    }
  }

}
