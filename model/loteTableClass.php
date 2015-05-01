<?php

use mvc\model\modelClass as model;
use mvc\config\configClass as config;

/**
 * Description of loteTableClass
 *
 * @author Gonzalo Andres Bejarano, Elcy Milena Guerrero, Andres Eduardo Bahamon
 */
class loteTableClass extends loteBaseTableClass {

  public static function getNameLote($id) {
    try {
      $sql = 'SELECT ' . loteTableClass::DESCRIPCION . ' As descripcion  '
              . '  FROM ' . loteTableClass::getNameTable() . '  '
              . '  WHERE ' . loteTableClass::ID . ' = :id';
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

  public static function getTotalPages($lines) {
    try {
      $sql = 'SELECT count(' . loteTableClass::ID . ') AS cantidad ' .
              ' FROM ' . loteTableClass::getNameTable() .
              ' WHERE ' . loteTableClass::DELETED_AT . ' IS NULL ';
      $answer = model::getInstance()->prepare($sql);
      $answer->execute();
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);
      return ceil($answer[0]->cantidad / $lines);
    } catch (PDOException $exc) {
      throw $exc;
    }
  }
  
  
  public static function loteInsert($ubicacion,$idCiudad,$tamano,$descripcion,$unidadDistancia) {
    try {
      $sql = 'INSERT INTO' .'  '. loteTableClass::getNameTable() . ' ('. loteTableClass::UBICACION . ',' . loteTableClass::TAMANO .','. loteTableClass::UNIDAD_DISTANCIA_ID .','. loteTableClass::DESCRIPCION .','. loteTableClass::ID_CIUDAD .' ) '
             . ' VALUES (' . "'" . $ubicacion . "'" .',' . $tamano . ','. $unidadDistancia . ',' . "'" . $descripcion . "'" . ',' . $idCiudad  . ' )';
      
             
        model::getInstance()->beginTransaction();
        model::getInstance()->exec($sql);
        model::getInstance()->commit();
    } catch (PDOException $exc) {
      throw $exc;
    }
  }
  
  
  public static function loteupdateMas($id,$fechaSiembra,$numero,$insumo,$presupuesto) {
    try {
        
      $sql = 'UPDATE ' . '  '. loteTableClass::getNameTable() . ' SET ' . ' '.  loteTableClass::FECHA_INICIO_SIEMBRA  .'='. "'" . $fechaSiembra  . "'" .','. loteTableClass::NUMERO_PLANTULAS . '=' .  $numero . ',' . loteTableClass::PRODUCTO_INSUMO_ID . '=' .  $insumo . ',' . loteTableClass::PRESUPUESTO . '=' . $presupuesto . '  '
             . ' WHERE '  .  loteTableClass::ID  . '=' . $id .  ' ';
      
             
        model::getInstance()->beginTransaction();
        model::getInstance()->exec($sql);
        model::getInstance()->commit();
    } catch (PDOException $exc) {
      throw $exc;
    }
  }

}
