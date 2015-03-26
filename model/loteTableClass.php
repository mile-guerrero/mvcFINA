<?php

use mvc\model\modelClass as model;
use mvc\config\configClass as config;

/**
 * Description of loteTableClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class loteTableClass extends loteBaseTableClass {
 
  public static function getTotalPages($lines){
    try {
      $sql = 'SELECT count(' . loteTableClass::ID . ') AS cantidad ' .
              ' FROM ' . loteTableClass::getNameTable() .
              ' WHERE '. loteTableClass::DELETED_AT . ' IS NULL ';
      $answer = model::getInstance()->prepare($sql);
      $answer->execute();
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);
      return ceil($answer[0]->cantidad/$lines);
    }  catch (PDOException $exc){
       throw  $exc;
  }}  
  
}
