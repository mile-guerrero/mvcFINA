<?php

use mvc\model\modelClass as model;
use mvc\config\configClass as config;

/**
 * Description of origenMaquinaTableClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class origenMaquinaTableClass extends origenMaquinaBaseTableClass {
  
  public static function getTotalPages($lines){
    try {
      $sql = 'SELECT count(' . origenMaquinaTableClass::ID . ') AS cantidad ' .
              ' FROM ' . origenMaquinaTableClass::getNameTable() ;
             
     
      $answer = model::getInstance()->prepare($sql);
      $answer->execute();
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);
      return ceil($answer[0]->cantidad/$lines);
    }  catch (PDOException $exc){
       throw  $exc;
  }} 
  
public static function getNameOrigenMaquina($id){
    try {
      $sql = 'SELECT ' . origenMaquinaTableClass::DESCRIPCION .  ' As nombrep  '
             . '  FROM ' . origenMaquinaTableClass::getNameTable() . '  '
             . '  WHERE ' . origenMaquinaTableClass::ID . ' = :id';
      $params = array(
          ':id' => $id
      );
      $answer = model::getInstance()->prepare($sql);
      $answer->execute($params);
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);
      return $answer[0]->nombrep;
      
    } catch (Exception $exc) {
      throw $exc;
    }
    
  }

}
