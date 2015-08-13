<?php

use mvc\model\modelClass as model;
use mvc\config\configClass as config;

/**
 * Description of plagaTableClass
 *
 * @author Gonzalo Andres Bejarano, Elcy Milena Guerrero, Andres Eduardo Bahamon
 */

class plagaTableClass extends plagaBaseTableClass {
 
    
    public static function getNamePlaga($id){
    try {
      $sql = 'SELECT ' . plagaTableClass::NOMBRE .  ' As nombre  '
             . '  FROM ' . plagaTableClass::getNameTable() . '  '
             . '  WHERE ' . plagaTableClass::ID . ' = :id';
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
      $sql = 'SELECT ' . plagaTableClass::DESCRIPCION .  ' As descripcion  '
             . '  FROM ' . plagaTableClass::getNameTable() . '  '
             . '  WHERE ' . plagaTableClass::ID . ' = :id';
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
      $sql = 'SELECT ' . plagaTableClass::TRATAMIENTO .  ' As tratamiento  '
             . '  FROM ' . plagaTableClass::getNameTable() . '  '
             . '  WHERE ' . plagaTableClass::ID . ' = :id';
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
