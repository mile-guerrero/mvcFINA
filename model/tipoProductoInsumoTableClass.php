<?php

use mvc\model\modelClass as model;
use mvc\config\configClass as config;

/**
 * Description of tipoProductoInsumoTableClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class tipoProductoInsumoTableClass extends tipoProductoInsumoBaseTableClass {
 
public static function getTotalPages($lines){
    try {
      $sql = 'SELECT count(' . tipoProductoInsumoTableClass::ID . ') AS cantidad ' .
              ' FROM ' .tipoProductoInsumoTableClass::getNameTable() .
              ' WHERE '. tipoProductoInsumoTableClass::DELETED_AT . ' IS NULL ';
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
