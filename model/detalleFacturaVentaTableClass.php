<?php

use mvc\model\modelClass as model;
use mvc\config\configClass as config;

/**
 * Description of credencialTableClass
 *
 * @author Andres Eduardo Bahamon, Elcy Milena Guerrero, Gonzalo Andres Bejarano
 */
class detalleFacturaVentaTableClass extends detalleFacturaVentaBaseTableClass {

  
  public static function getNameTotalPagar($idFacturar){
    try {
      $sql = 'SELECT ' . '  '. 'SUM ('. detalleFacturaVentaTableClass::VALOR_TOTAL  . ') ' .  ' As total'
             . '  FROM ' . detalleFacturaVentaTableClass::getNameTable() . '  ' 
             . ' WHERE ' . detalleFacturaVentaTableClass::FACTURA_ID . ' = ' . $idFacturar;
    
      $answer = model::getInstance()->prepare($sql);
            $answer->execute();
            $answer = $answer->fetchAll(PDO::FETCH_OBJ);
//       print_r($sql);
//     exit();
      return $answer[0]->total;
      
      
    } catch (Exception $exc) {
      throw $exc;
    }
    
  }
  public static function getTotalPages($lines) {
    try {
      $sql = 'SELECT count(' . detalleFacturaVentaTableClass::ID . ') AS cantidad ' .
              ' FROM ' . detalleFacturaVentaTableClass::getNameTable();
              
      $answer = model::getInstance()->prepare($sql);
      $answer->execute();
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);
      return ceil($answer[0]->cantidad / $lines);
    } catch (PDOException $exc) {
      throw $exc;
    }
  }
  
  public static function getNameDetalleFactura($id){
    try {
      $sql = 'SELECT ' . detalleFacturaVentaTableClass::ID .  ' As id'
             . '  FROM ' . detalleFacturaVentaTableClass::getNameTable() . '  '
             . '  WHERE ' . detalleFacturaVentaTableClass::ID . ' = :id';
      $params = array(
          ':id'  => $id
      );
      $answer = model::getInstance()->prepare($sql);
      $answer->execute($params);
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);
      return $answer[0]->id;
      
    } catch (Exception $exc) {
      throw $exc;
    }
    
  }
  
   public static function getTraerInsumo($idTipoInsumo){
    try {
      $sql = 'SELECT ' . productoInsumoTableClass::getNameTable() . '.'. productoInsumoTableClass::DESCRIPCION .  ' As descripcion ' . '  ' 
             . '  FROM ' . productoInsumoTableClass::getNameTable() . ','. tipoProductoInsumoTableClass::getNameTable() . '  '
             . '  WHERE ' .  productoInsumoTableClass::getNameField(productoInsumoTableClass::TIPO_PRODUCTO_INSUMO_ID) . ' = '. tipoProductoInsumoTableClass::getNameField(tipoProductoInsumoTableClass::ID) . ' AND ' . tipoProductoInsumoTableClass::getNameField(tipoProductoInsumoTableClass::ID) . ' = ' . $idTipoInsumo ;
//      print_r($sql);
//        exit();
//     $params = array(
//          ':idTipoInsumo'  => $idTipoInsumo
//      );
//      $answer = model::getInstance()->prepare($sql);
//      $answer->execute($params);
//      $answer = $answer->fetchAll(PDO::FETCH_OBJ);
  $answer = model::getInstance()->prepare($sql);
            $answer->execute();
            $answer = $answer->fetchAll(PDO::FETCH_OBJ);
      return $answer[0]->descripcion;
   } catch (Exception $exc) {
      throw $exc;
    }
  }

   public static function getTraerId($idTipoInsumo){
    try {
      $sql = 'SELECT ' . productoInsumoTableClass::getNameTable() . '.'. productoInsumoTableClass::ID . ' As id ' . '  '
             . '  FROM ' . productoInsumoTableClass::getNameTable() . ','. tipoProductoInsumoTableClass::getNameTable() . '  '
             . '  WHERE ' .  productoInsumoTableClass::getNameField(productoInsumoTableClass::TIPO_PRODUCTO_INSUMO_ID) . ' = '. tipoProductoInsumoTableClass::getNameField(tipoProductoInsumoTableClass::ID) . ' AND ' . tipoProductoInsumoTableClass::getNameField(tipoProductoInsumoTableClass::ID) . ' = ' . $idTipoInsumo ;
//      print_r($sql);
//        exit();
//     $params = array(
//          ':idTipoInsumo'  => $idTipoInsumo
//      );
//      $answer = model::getInstance()->prepare($sql);
//      $answer->execute($params);
//      $answer = $answer->fetchAll(PDO::FETCH_OBJ);
  $answer = model::getInstance()->prepare($sql);
            $answer->execute();
            $answer = $answer->fetchAll(PDO::FETCH_OBJ);
    return $answer[0]->id;
   } catch (Exception $exc) {
      throw $exc;
    }
  }
}
