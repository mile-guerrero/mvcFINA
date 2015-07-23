<?php

use mvc\model\modelClass as model;
use mvc\config\configClass as config;

/**
 * Description of imagenTableClass
 *
 * @author Gonzalo Andres Bejarano, Elcy Milena Guerrero, Andres Eduardo Bahamon
 */

class imagenTableClass extends imagenBaseTableClass {
  public static function getTotalPages($lines){
    try {
      $sql = 'SELECT count(' . imagenTableClass::ID . ') AS cantidad ' .
              ' FROM ' .imagenTableClass::getNameTable() ;
      $answer = model::getInstance()->prepare($sql);
      $answer->execute();
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);
      return ceil($answer[0]->cantidad/$lines);
    }  catch (PDOException $exc){
       throw  $exc;
  }
}


public static function deleteImagen($id){
    try {
      $sql = 'DELETE FROM ' . imagenTableClass::getNameTable() .  '  ' . '  WHERE ' . imagenTableClass::ID . ' = ' . $id ;
      model::getInstance()->beginTransaction();
      model::getInstance()->exec($sql);
      model::getInstance()->commit();
    
     
      
    } catch (Exception $exc) {
      throw $exc;
    }
}

public static function getNameImagen($id){
    try {
     
     $extencion="jpg";
      $sql =  'SELECT ' . imagenTableClass::EXTENCION .'  As extencion   ' . ' , '. imagenTableClass::NOMBRE .  ' As nombre  '
             . '  FROM ' . imagenTableClass::getNameTable() . '  '
             . '  WHERE '  .imagenTableClass::ID . ' = :id' . ' ' . 'AND' . ' ' .imagenTableClass::EXTENCION . ' = :extencion';
              
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
//      $sql =  'SELECT ' . imagenTableClass::EXTENCION .'  As extencion   ' . ' , '. imagenTableClass::NOMBRE .  ' As nombre  '
//             . '  FROM ' . imagenTableClass::getNameTable() . '  '
//             . '  WHERE '  .imagenTableClass::ID . ' = :id' . ' ' . 'AND' . ' ' .imagenTableClass::EXTENCION . ' = :extencion';
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