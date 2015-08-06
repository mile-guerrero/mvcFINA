<?php

use mvc\model\modelClass as model;
use mvc\config\configClass as config;

/**
 * Description of laborTableClass
 *
 * @author Gonzalo Andres Bejarano, Elcy Milena Guerrero, Andres Eduardo Bahamon
 */

class laborTableClass extends laborBaseTableClass {
 public static function getTotalPages($lines, $where){
    try {
      $sql = 'SELECT count( ' . laborTableClass::ID . ' ) AS cantidad ' .
              ' FROM ' . ' ' . laborTableClass::getNameTable() . ' ';
      
       if (is_array($where) === true){
          foreach ($where as $field => $value){
              if (is_array($value)){
                  $sql = $sql . ' WHERE ' . $field . ' BETWEEN ' . ((is_numeric($value[0])) ? $value[0] : "'$value[0]'") . ' AND ' . ((is_numeric($value[1]) ? $value[1] : "'$value[1]'"));
              }  if(is_numeric($field)) {
                  $sql = $sql . ' WHERE ' . $value;
              } else {
                  $sql = $sql . ' WHERE ' . $field . ' = ' . ((is_numeric($value)) ? $value : "'$value'");
              }
          }
      }
      
      $answer = model::getInstance()->prepare($sql);
      $answer->execute();
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);
      return ceil($answer[0]->cantidad/$lines);
    }  catch (PDOException $exc){
       throw  $exc;
  }
}
public static function getNameLabor($id){
    try {
      $sql = 'SELECT ' . laborTableClass::DESCRIPCION .  ' As descripcion  '
             . '  FROM ' . laborTableClass::getNameTable() . '  '
             . '  WHERE ' . laborTableClass::ID . ' = :id';
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
