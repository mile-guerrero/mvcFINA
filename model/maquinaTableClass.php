<?php

use mvc\model\modelClass as model;
use mvc\config\configClass as config;

/**
 * Description of maquinaTableClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class maquinaTableClass extends maquinaBaseTableClass {

  public static function getTotalPages($lines){
    try {
      $sql = 'SELECT count(' . maquinaTableClass::ID . ') AS cantidad ' .
              ' FROM ' . maquinaTableClass::getNameTable() .
              ' WHERE '. maquinaTableClass::DELETED_AT . ' IS NULL ';
      $answer = model::getInstance()->prepare($sql);
      $answer->execute();
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);
      return ceil($answer[0]->cantidad/$lines);
    }  catch (PDOException $exc){
       throw  $exc;
  }}  

}
