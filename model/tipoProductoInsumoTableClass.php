<?php

use mvc\model\modelClass as model;
use mvc\config\configClass as config;

/**
 * Description of tipoProductoInsumoTableClass
 *
 * @author Gonzalo Andres Bejarano, Elcy Milena Guerrero, Andres Eduardo Bahamon
 */
class tipoProductoInsumoTableClass extends tipoProductoInsumoBaseTableClass {
 
public static function getTotalPages($lines, $where){
    try {
      $sql = 'SELECT count(' . tipoProductoInsumoTableClass::ID . ') AS cantidad ' .
              ' FROM ' .tipoProductoInsumoTableClass::getNameTable() .
              ' WHERE '. tipoProductoInsumoTableClass::DELETED_AT . ' IS NULL ';
      
      if (is_array($where) === true){
          foreach ($where as $field => $value){
              if (is_array($value)){
                  $sql = $sql . ' AND ' . $field . ' BETWEEN ' . ((is_numeric($value[0])) ? $value[0] : "'$value[0]'") . ' AND ' . ((is_numeric($value[1]) ? $value[1] : "'$value[1]'"));
              }  if(is_numeric($field)) {
                  $sql = $sql . 'AND ' . $value;
              } else {
                  $sql = $sql . ' AND ' . ' = ' . ((is_numeric($value)) ? $value : "'$value'");
              }
          }
      }
      
      $answer = model::getInstance()->prepare($sql);
      $answer->execute();
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);
      return ceil($answer[0]->cantidad/$lines);
    }  catch (PDOException $exc){
       throw  $exc;
  }} 

public static function getNameTipoProductoInsumo($id){
    try {
      $sql = 'SELECT ' . tipoProductoInsumoTableClass::DESCRIPCION .  ' As des  '
             . '  FROM ' . tipoProductoInsumoTableClass::getNameTable() . '  '
             . '  WHERE ' . tipoProductoInsumoTableClass::ID . ' = :id';
      $params = array(
          ':id' => $id
      );
      $answer = model::getInstance()->prepare($sql);
      $answer->execute($params);
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);
      return $answer[0]->des;
      
    } catch (Exception $exc) {
      throw $exc;
    }
    
  }

}
