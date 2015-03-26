<?php

use mvc\model\modelClass as model;

/**
 * Description of credencialTableClass
 *
 * @author 
 */
class proveedorTableClass extends proveedorBaseTableClass {

 public static function getTotalPages($lines){
    try {
      $sql = 'SELECT count(' . proveedorTableClass::ID . ') AS cantidad '.
              ' FROM ' . proveedorTableClass::getNameTable() .
              ' WHERE '. proveedorTableClass::DELETED_AT . ' IS NULL ';
      $answer = model::getInstance()->prepare($sql);
      $answer->execute();
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);
      return ceil($answer[0]->cantidad/$lines);
    }  catch (PDOException $exc){
       throw  $exc;
    }
  }  
  
public static function getNameProveedor($id){
    try {
      $sql = 'SELECT ' . proveedorTableClass::NOMBREP .  ' As nombrep  '
             . '  FROM ' . proveedorTableClass::getNameTable() . '  '
             . '  WHERE ' . proveedorTableClass::ID . ' = :id';
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
