<?php

use mvc\model\modelClass as model;
use mvc\config\configClass as config;

/**
 * Description of enfermedadTableClass
 *
 * @author Gonzalo Andres Bejarano, Elcy Milena Guerrero, Andres Eduardo Bahamon
 */

class enfermedadTableClass extends enfermedadBaseTableClass {
  public static function getTotalPages($lines){
    try {
      $sql = 'SELECT count(' . enfermedadTableClass::ID . ') AS cantidad ' .
              ' FROM ' .enfermedadTableClass::getNameTable() .
              ' WHERE '. enfermedadTableClass::DELETED_AT . ' IS NULL ';
      $answer = model::getInstance()->prepare($sql);
      $answer->execute();
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);
      return ceil($answer[0]->cantidad/$lines);
    }  catch (PDOException $exc){
       throw  $exc;
  }
  
    }
    
    public static function getNameEnfermedad($id){
    try {
      $sql = 'SELECT ' . enfermedadTableClass::NOMBRE .  ' As nombre  '
             . '  FROM ' . enfermedadTableClass::getNameTable() . '  '
             . '  WHERE ' . enfermedadTableClass::ID . ' = :id';
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
  
  public static function getNameDes($id){
    try {
      $sql = 'SELECT ' . enfermedadTableClass::DESCRIPCION .  ' As descripcion  '
             . '  FROM ' . enfermedadTableClass::getNameTable() . '  '
             . '  WHERE ' . enfermedadTableClass::ID . ' = :id';
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
  
   public static function getNameTratamiento($id){
    try {
      $sql = 'SELECT ' . enfermedadTableClass::TRATAMIENTO .  ' As tratamiento  '
             . '  FROM ' . enfermedadTableClass::getNameTable() . '  '
             . '  WHERE ' . enfermedadTableClass::ID . ' = :id';
      $params = array(
          ':id' => $id
      );
      $answer = model::getInstance()->prepare($sql);
      $answer->execute($params);
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);
      return $answer[0]->tratamiento;
   } catch (Exception $exc) {
      throw $exc;
    }
  }
   
  
}
