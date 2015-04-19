<?php

use mvc\model\modelClass as model;
use mvc\config\configClass as config;

/**
 * Description of productoInsumoTableClass
 *
 * @author Gonzalo Andres Bejarano, Elcy Milena Guerrero, Andres Eduardo Bahamon
 */
class productoInsumoTableClass extends productoInsumoBaseTableClass {
  
  public static function getNameProductoInsumo($id){
    try {
      $sql = 'SELECT ' . productoInsumoTableClass::DESCRIPCION .  ' As descripcion  '
             . '  FROM ' . productoInsumoTableClass::getNameTable() . '  '
             . '  WHERE ' . productoInsumoTableClass::ID . ' = :id';
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
  
   public static function getTotalPages($lines){
    try {
      $sql = 'SELECT count(' . productoInsumoTableClass::ID . ') AS cantidad ' .
              ' FROM ' .productoInsumoTableClass::getNameTable() .
              ' WHERE '. productoInsumoTableClass::DELETED_AT . ' IS NULL ';
      $answer = model::getInstance()->prepare($sql);
      $answer->execute();
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);
      return ceil($answer[0]->cantidad/$lines);
    }  catch (PDOException $exc){
       throw  $exc;
  }
}
}
