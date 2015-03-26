<?php

use mvc\model\modelClass as model;
use mvc\config\configClass as config;

/**
 * Description of productoInsumoTableClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class productoInsumoTableClass extends productoInsumoBaseTableClass {
  
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
  }}


}
