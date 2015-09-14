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
  
  public static function getInsumo($idVenta){
    try {
      $sql = 'SELECT ' . '  ' . detalleFacturaVentaTableClass::DESCRIPCION  .  ' As producto_insumo_id'
             . '  FROM ' . detalleFacturaVentaTableClass::getNameTable() . '  ' 
             . ' WHERE ' . detalleFacturaVentaTableClass::ID . ' = ' . $idVenta;
    
      $answer = model::getInstance()->prepare($sql);
            $answer->execute();
            $answer = $answer->fetchAll(PDO::FETCH_OBJ);
//       print_r($sql);
//     exit();
      return $answer[0]->producto_insumo_id;
      
      
    } catch (Exception $exc) {
      throw $exc;
    }
    
  }
  
  public static function getTipoInsumo($idProducto){
    try {
      $sql = 'SELECT ' . '  ' . tipoProductoInsumoTableClass::getNameTable() . '.' . tipoProductoInsumoTableClass::ID  .  ' As id'
             . '  FROM ' . detalleFacturaVentaTableClass::getNameTable() . ' , ' . productoInsumoTableClass::getNameTable() . ' , ' . tipoProductoInsumoTableClass::getNameTable() . '  '
             . ' WHERE ' .  detalleFacturaVentaTableClass::getNameField(detalleFacturaVentaTableClass::DESCRIPCION) . ' = '. productoInsumoTableClass::getNameField(productoInsumoTableClass::ID) . ' AND ' .  productoInsumoTableClass::getNameField(productoInsumoTableClass::TIPO_PRODUCTO_INSUMO_ID) . ' = '. tipoProductoInsumoTableClass::getNameField(tipoProductoInsumoTableClass::ID) . ' AND '  . detalleFacturaVentaTableClass::getNameTable() . '.'. detalleFacturaVentaTableClass::DESCRIPCION . ' = ' . $idProducto;
    
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
      $sql = 'SELECT ' . productoInsumoTableClass::getNameTable() . '.'. productoInsumoTableClass::DESCRIPCION .  ' As descripcion ' . ' , ' . productoInsumoTableClass::getNameTable() . '.'. productoInsumoTableClass::ID . ' As id ' . '  '
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
      return (count($answer) > 0) ? $answer : array();
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
