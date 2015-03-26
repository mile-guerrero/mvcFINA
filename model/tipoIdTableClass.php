<?php

use mvc\model\modelClass as model;
use mvc\config\configClass as config;

/**
 * Description of tipoIdTableClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class tipoIdTableClass extends tipoIdBaseTableClass {
  
  public static function getTotalPages($lines){
    try {
      $sql = 'SELECT count(' . tipoIdTableClass::ID . ') AS cantidad ' .
              ' FROM ' .tipoIdTableClass::getNameTable();
      $answer = model::getInstance()->prepare($sql);
      $answer->execute();
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);
      return ceil($answer[0]->cantidad/$lines);
    }  catch (PDOException $exc){
       throw  $exc;
  }}

  public static function getNameTipoId($id){
    try {
      $sql = 'SELECT ' . tipoIdTableClass::DESCRIPCION .  ' As descripcion  '
             . '  FROM ' . tipoIdTableClass::getNameTable() . '  '
             . '  WHERE ' . tipoIdTableClass::ID . ' = :id';
      $params = array(
          ':id' => $id
      );
      $answer = model::getInstance()->prepare($sql);
      $answer->execute($params);
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);
      return $answer[0]->descripcion;
      
    } catch (Exception $exc) {
      throw $exc;
    }
    
  }
}
