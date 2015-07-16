<?php

use mvc\model\modelClass as model;
use mvc\config\configClass as config;

/**
 * Description of videoTableClass
 *
 * @author Gonzalo Andres Bejarano, Elcy Milena Guerrero, Andres Eduardo Bahamon
 */

class videoTableClass extends videoBaseTableClass {
  public static function getTotalPages($lines){
    try {
      $sql = 'SELECT count(' . videoTableClass::ID . ') AS cantidad ' .
              ' FROM ' .videoTableClass::getNameTable() ;
      $answer = model::getInstance()->prepare($sql);
      $answer->execute();
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);
      return ceil($answer[0]->cantidad/$lines);
    }  catch (PDOException $exc){
       throw  $exc;
  }
}


public static function deleteVideo($id){
    try {
      $sql = 'DELETE FROM ' . videoTableClass::getNameTable() .  '  ' . '  WHERE ' . videoTableClass::ID . ' = ' . $id ;
      model::getInstance()->beginTransaction();
      model::getInstance()->exec($sql);
      model::getInstance()->commit();
    
     
      
    } catch (Exception $exc) {
      throw $exc;
    }
}

public static function getNameVideo($id){
    try {
     
      $extencion='mp4';
      $sql =  'SELECT ' . videoTableClass::EXTENCION .'  As extencion   ' . ' , '. videoTableClass::NOMBRE .  ' As nombre  '
             . '  FROM ' . videoTableClass::getNameTable() . '  '
             . '  WHERE '  .videoTableClass::ID . ' = :id' . ' ' . 'AND' . ' ' .videoTableClass::EXTENCION . ' = :extencion';
              
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
//      $sql =  'SELECT ' . videoTableClass::EXTENCION .'  As extencion   ' . ' , '. videoTableClass::NOMBRE .  ' As nombre  '
//             . '  FROM ' . videoTableClass::getNameTable() . '  '
//             . '  WHERE '  .videoTableClass::ID . ' = :id' . ' ' . 'AND' . ' ' .videoTableClass::EXTENCION . ' = :extencion';
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