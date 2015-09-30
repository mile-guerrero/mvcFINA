<?php

use mvc\model\modelClass as model;
use mvc\config\configClass as config;

/**
 * Description of viveroTableClass
 *
 * @author Gonzalo Andres Bejarano, Elcy Milena Guerrero, Andres Eduardo Bahamon
 */
class viveroTableClass extends viveroBaseTableClass {
   
  public static function getTotalPages($lines, $where){
    try {
      $sql = 'SELECT count(' . viveroTableClass::ID . ') AS cantidad ' .
              ' FROM ' .viveroTableClass::getNameTable() .
              ' WHERE '. viveroTableClass::DELETED_AT . ' IS NULL ';
      
      if (is_array($where) === true){
          foreach ($where as $field => $value){
              if (is_array($value)){
                  $sql = $sql . ' AND ' . $field . ' BETWEEN ' . ((is_numeric($value[0])) ? $value[0] : "'$value[0]'") . ' AND ' . ((is_numeric($value[1]) ? $value[1] : "'$value[1]'"));
              }  if(is_numeric($field)) {
                  $sql = $sql . 'AND ' . $value;
              } else {
                  $sql = $sql . ' AND ' . $field . ' = ' . ((is_numeric($value)) ? $value : "'$value'");
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
}
