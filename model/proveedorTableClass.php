<?php

use mvc\model\modelClass as model;

/**
 * Description of credencialTableClass
 *
 * @author Gonzalo Andres Bejarano, Elcy Milena Guerrero, Andres Eduardo Bahamon
 */
class proveedorTableClass extends proveedorBaseTableClass {
public static function getTotalPages($lines, $where){
    try {
      $sql = 'SELECT count(' . proveedorTableClass::ID . ') AS cantidad '.
              ' FROM ' . proveedorTableClass::getNameTable() .
              ' WHERE '. proveedorTableClass::DELETED_AT . ' IS NULL ';
      
      if (is_array($where) === true){
          foreach ($where as $field => $value){
              if (is_array($value)){
                  $sql = $sql . ' AND ' . $field . ' BETWEEN ' . ((is_numeric($value[0])) ? $value[0] : "'$value[0]'") . ' AND ' . ((is_numeric($value[1]) ? $value[1] : "'$value[1]'"));
              }  if(is_numeric($field)) {
                  $sql = $sql . 'AND ' . $value;
              } else {
                  $sql = $sql . ' AND ' . ' = ' . ((is_numeric($value)) ? $value : "'$value'");
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
  
  public static function getApellidoProveedor($id){
    try {
      $sql = 'SELECT ' . proveedorTableClass::APELLIDO .  ' As apellido  '
             . '  FROM ' . proveedorTableClass::getNameTable() . '  '
             . '  WHERE ' . proveedorTableClass::ID . ' = :id';
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
  
  public static function getDocumentoProveedor($id){
    try {
      $sql = 'SELECT ' . proveedorTableClass::DOCUMENTO .  ' As documento  '
             . '  FROM ' . proveedorTableClass::getNameTable() . '  '
             . '  WHERE ' . proveedorTableClass::ID . ' = :id';
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
  
 public static function getNameDireccion($id){
    try {
      $sql = 'SELECT ' . proveedorTableClass::DIRECCION .  ' As direccion  '
             . '  FROM ' . proveedorTableClass::getNameTable() . '  '
             . '  WHERE ' . proveedorTableClass::ID . ' = :id';
      $params = array(
          ':id' => $id
      );
      $answer = model::getInstance()->prepare($sql);
      $answer->execute($params);
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);
      return $answer[0]->direccion;
      
    } catch (Exception $exc) {
      throw $exc;
    }
    
  }
  
  public static function getNameTelefono($id){
    try {
      $sql = 'SELECT ' . proveedorTableClass::TELEFONO .  ' As telefono  '
             . '  FROM ' . proveedorTableClass::getNameTable() . '  '
             . '  WHERE ' . proveedorTableClass::ID . ' = :id';
      $params = array(
          ':id' => $id
      );
      $answer = model::getInstance()->prepare($sql);
      $answer->execute($params);
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);
      return $answer[0]->telefono;
      
    } catch (Exception $exc) {
      throw $exc;
    }
    
  }
}
