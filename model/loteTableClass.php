<?php

use mvc\model\modelClass as model;
use mvc\config\configClass as config;

/**
 * Description of loteTableClass
 *
 * @author Gonzalo Andres Bejarano, Elcy Milena Guerrero, Andres Eduardo Bahamon
 */
class loteTableClass extends loteBaseTableClass {
  
  
  public static function getTipoInsumo($idProducto){
    try {
      $sql = 'SELECT ' . '  ' . tipoProductoInsumoTableClass::getNameTable() . '.' . tipoProductoInsumoTableClass::ID  .  ' As id'
             . '  FROM ' . loteTableClass::getNameTable() . ' , ' . productoInsumoTableClass::getNameTable() . ' , ' . tipoProductoInsumoTableClass::getNameTable() . '  '
             . ' WHERE ' .  loteTableClass::getNameField(loteTableClass::PRODUCTO_INSUMO_ID) . ' = '. productoInsumoTableClass::getNameField(productoInsumoTableClass::ID) . ' AND ' .  productoInsumoTableClass::getNameField(productoInsumoTableClass::TIPO_PRODUCTO_INSUMO_ID) . ' = '. tipoProductoInsumoTableClass::getNameField(tipoProductoInsumoTableClass::ID) . ' AND '  . loteTableClass::getNameTable() . '.'. loteTableClass::PRODUCTO_INSUMO_ID . ' = ' . $idProducto;
    
      $answer = model::getInstance()->prepare($sql);
            $answer->execute();
            $answer = $answer->fetchAll(PDO::FETCH_OBJ);
//       print_r($sql);
//     exit();
      return $answer[0]->id;
      
      
    } catch (Exception $exc) {
      throw $exc;
    }
    
  }

  public static function getNumeros() {
        try {
            $sql = 'SELECT count(' . loteTableClass::ID . ') AS cantidad ' .
                    ' FROM ' . loteTableClass::getNameTable() .
                    ' WHERE ' . loteTableClass::DELETED_AT . ' IS NULL ';
            $answer = model::getInstance()->prepare($sql);
            $answer->execute();
            $answer = $answer->fetchAll(PDO::FETCH_OBJ);
      return $answer[0]->cantidad;
        } catch (PDOException $exc) {
            throw $exc;
        }
    }
    

  
  public static function getNameLote($id) {
    try {
      $sql = 'SELECT ' . loteTableClass::UBICACION . ' As descripcion  '
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
  
   public static function getNameFechaRiego($id) {
    try {
      $sql = 'SELECT ' . loteTableClass::FECHA_RIEGO . ' As fecha_riego  '
              . '  FROM ' . loteTableClass::getNameTable() . '  '
              . '  WHERE ' . loteTableClass::ID . ' = :id';
      $params = array(
          ':id' => $id
      );
      $answer = model::getInstance()->prepare($sql);
      $answer->execute($params);
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);
      return $answer[0]->fecha_riego;
    } catch (Exception $exc) {
      throw $exc;
    }
  }

   public static function getTotalPages($lines, $where) {
    try {
      $sql = 'SELECT count(' . loteTableClass::ID . ') AS cantidad ' .
              ' FROM ' . loteTableClass::getNameTable() .
              ' WHERE ' . loteTableClass::DELETED_AT . ' IS NULL ';
      
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

  public static function loteInsert($ubicacion, $idCiudad, $tamano, $descripcion, $unidadDistancia) {
    try {
      $sql = 'INSERT INTO' . '  ' . loteTableClass::getNameTable() . ' (' . loteTableClass::UBICACION . ',' . loteTableClass::TAMANO . ',' . loteTableClass::UNIDAD_DISTANCIA_ID . ',' . loteTableClass::DESCRIPCION . ',' . loteTableClass::ID_CIUDAD  . ',' . loteTableClass::NUMERO_PLANTULAS . ',' . loteTableClass::PRESUPUESTO . ',' . loteTableClass::PRODUCCION . ',' . loteTableClass::UNIDAD_MEDIDA_ID .' ) '
              . ' VALUES (' . "'" . $ubicacion . "'" . ',' . $tamano . ',' . $unidadDistancia . ',' . "'" . $descripcion . "'" . ',' . $idCiudad . ',' . 0 . ',' . 0 . ',' . 0 . ',' . 2 .' )';


      model::getInstance()->beginTransaction();
      model::getInstance()->exec($sql);
      model::getInstance()->commit();
    } catch (PDOException $exc) {
      throw $exc;
    }
  }

  public static function loteupdateMas($id, $fechaSiembra, $fechaRiego, $numero, $insumo, $presupuesto, $produccion, $unidadMedida) {
    try {

      $sql = 'UPDATE ' . '  ' . loteTableClass::getNameTable() . ' SET ' . ' ' . loteTableClass::FECHA_INICIO_SIEMBRA . '=' . "'" . $fechaSiembra . "'" . ',' . loteTableClass::FECHA_RIEGO . '=' . "'" . $fechaRiego . "'" . ',' . loteTableClass::NUMERO_PLANTULAS . '=' . $numero . ',' . loteTableClass::PRODUCTO_INSUMO_ID . '=' . $insumo . ',' . loteTableClass::PRESUPUESTO . '=' . $presupuesto . ',' . loteTableClass::PRODUCCION . '=' . $produccion . ',' . loteTableClass::UNIDAD_MEDIDA_ID . '=' . $unidadMedida . '  '
              . ' WHERE ' . loteTableClass::ID . '=' . $id . ' ';


      model::getInstance()->beginTransaction();
      model::getInstance()->exec($sql);
      model::getInstance()->commit();
    } catch (PDOException $exc) {
      throw $exc;
    }
  }
  
}
