<?php

use mvc\model\modelClass as model;
use mvc\config\configClass as config;

/**
 * Description of tipoUsoMaquinaTableClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class tipoUsoMaquinaTableClass extends tipoUsoMaquinaBaseTableClass {

public static function getTotalPages($lines){
    try {
      $sql = 'SELECT count(' . tipoUsoMaquinaTableClass::ID . ') AS cantidad ' .
              ' FROM ' .tipoUsoMaquinaTableClass::getNameTable();
      $answer = model::getInstance()->prepare($sql);
      $answer->execute();
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);
      return ceil($answer[0]->cantidad/$lines);
    }  catch (PDOException $exc){
       throw  $exc;
  }}  
  
public static function getNameTipoUsoMaquina($id){
    try {
      $sql = 'SELECT ' . tipoUsoMaquinaTableClass::DESCRIPCION .  ' As descripcion  '
             . '  FROM ' . tipoUsoMaquinaTableClass::getNameTable() . '  '
             . '  WHERE ' . tipoUsoMaquinaTableClass::ID . ' = :id';
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
