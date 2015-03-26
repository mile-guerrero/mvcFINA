<?php

use mvc\model\modelClass as model;
use mvc\config\configClass as config;

/**
 * Description of usuarioCredencialTableClass
 *
 * @author gonzalo bejarano
 */
class usuarioCredencialTableClass extends usuarioCredencialBaseTableClass {
 public static function getTotalPages($lines){
    try {
      $sql = 'SELECT count(' . usuarioCredencialTableClass::ID . ') AS cantidad ' .
              ' FROM ' .usuarioCredencialTableClass::getNameTable();
      $answer = model::getInstance()->prepare($sql);
      $answer->execute();
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);
      return ceil($answer[0]->cantidad/$lines);
    }  catch (PDOException $exc){
       throw  $exc;
  }}
}