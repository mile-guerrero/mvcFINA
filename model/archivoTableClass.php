<?php

use mvc\model\modelClass as model;
use mvc\config\configClass as config;

/**
 * Description of archivoTableClass
 *
 * @author Gonzalo Andres Bejarano, Elcy Milena Guerrero, Andres Eduardo Bahamon
 */

class archivoTableClass extends archivoBaseTableClass {
  public static function getTotalPages($lines){
    try {
      $sql = 'SELECT count(' . archivoTableClass::ID . ') AS cantidad ' .
              ' FROM ' .archivoTableClass::getNameTable() ;
      $answer = model::getInstance()->prepare($sql);
      $answer->execute();
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);
      return ceil($answer[0]->cantidad/$lines);
    }  catch (PDOException $exc){
       throw  $exc;
  }
}


public static function deleteArchivo($id){
    try {
      $sql = 'DELETE FROM ' . archivoTableClass::getNameTable() .  '  ' . '  WHERE ' . archivoTableClass::ID . ' = ' . $id ;
      model::getInstance()->beginTransaction();
      model::getInstance()->exec($sql);
      model::getInstance()->commit();
    
     
      
    } catch (Exception $exc) {
      throw $exc;
    }
}

public static function getNameArchivo($id){
    try {
     
      $extencion='jpg';
      $sql =  'SELECT ' . archivoTableClass::EXTENCION .'  As extencion   ' . ' , '. archivoTableClass::NOMBRE .  ' As nombre  '
             . '  FROM ' . archivoTableClass::getNameTable() . '  '
             . '  WHERE '  .archivoTableClass::ID . ' = :id' . ' ' . 'AND' . ' ' .archivoTableClass::EXTENCION . ' = :extencion';
              
      $params = array(
          ':id' => $id,
          ':extencion' => $extencion
      );
      $answer = model::getInstance()->prepare($sql);
      $answer->execute($params);
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);
      return $answer[0]->nombre;
      
    } catch (Exception $exc) {
      throw $exc;
    }

}

//public static function getNameArchivo($id){
//    try {
//      $extencion='jpg';
//      $sql =  'SELECT ' . archivoTableClass::EXTENCION .'  As extencion   ' . ' , '. archivoTableClass::NOMBRE .  ' As nombre  '
//             . '  FROM ' . archivoTableClass::getNameTable() . '  '
//             . '  WHERE '  .archivoTableClass::ID . ' = :id' . ' ' . 'AND' . ' ' .archivoTableClass::EXTENCION . ' = :extencion';
//              
//      $params = array(
//          ':id' => $id,
//          ':extencion' => $extencion
//      );
//      $answer = model::getInstance()->prepare($sql);
//      $answer->execute($params);
//      $answer = $answer->fetchAll(PDO::FETCH_OBJ);
//      return $answer[0]->nombre;
//      
//    } catch (Exception $exc) {
//      throw $exc;
//    }
//
//}

}