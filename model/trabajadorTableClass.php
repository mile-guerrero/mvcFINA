<?php

use mvc\model\modelClass as model;
use mvc\config\configClass as config;

/**
 * Description of credencialTableClass
 *
 * @author Gonzalo Andres Bejarano, Elcy Milena Guerrero, Andres Eduardo Bahamon
 */
class trabajadorTableClass extends trabajadorBaseTableClass {
  
  public static function getNameTrabajador($id){
    try {
      $sql = 'SELECT ' . trabajadorTableClass::NOMBRET .  ' As nombre  '
             . '  FROM ' . trabajadorTableClass::getNameTable() . '  '
             . '  WHERE ' . trabajadorTableClass::ID . ' = :id';
      $params = array(
          ':id' => $id
      );
      $answer = model::getInstance()->prepare($sql);
      $answer->execute($params);
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);
      return $answer[0]->nombre;
      
    } catch (Exception $exc) {
      throw $exc;
    }
    
  }
  
   public static function getNameDocumento($id){
    try {
      $sql = 'SELECT ' . trabajadorTableClass::DOCUMENTO .  ' As documento  '
             . '  FROM ' . trabajadorTableClass::getNameTable() . '  '
             . '  WHERE ' . trabajadorTableClass::ID . ' = :id';
      $params = array(
          ':id' => $id
      );
      $answer = model::getInstance()->prepare($sql);
      $answer->execute($params);
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);
      return $answer[0]->documento;
      
    } catch (Exception $exc) {
      throw $exc;
    }
    
  }
  
    public static function getNameApellido($id){
    try {
      $sql = 'SELECT ' . trabajadorTableClass::APELLIDO .  ' As apellido  '
             . '  FROM ' . trabajadorTableClass::getNameTable() . '  '
             . '  WHERE ' . trabajadorTableClass::ID . ' = :id';
      $params = array(
          ':id' => $id
      );
      $answer = model::getInstance()->prepare($sql);
      $answer->execute($params);
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);
      return $answer[0]->apellido;
      
    } catch (Exception $exc) {
      throw $exc;
    }
    
  }
  
public static function getTotalPages($lines, $where) {
    try {
      $sql = 'SELECT count(' . trabajadorTableClass::ID . ') AS cantidad ' .
              ' FROM ' . trabajadorTableClass::getNameTable() .
              ' WHERE ' . trabajadorTableClass::DELETED_AT . ' IS NULL ';
      
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
      return ceil($answer[0]->cantidad / $lines);
    } catch (PDOException $exc) {
      throw $exc;
    }
  }

}
