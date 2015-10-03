<?php

use mvc\model\modelClass as model;
use mvc\config\configClass as config;
use mvc\session\sessionClass as session;
/**
 * Description of credencialTableClass
 *
 * @author Andres Eduardo Bahamon, Elcy Milena Guerrero, Gonzalo Andres Bejarano
 */
class detalleFacturaCompraTableClass extends detalleFacturaCompraBaseTableClass {

  public static function getTotalPages($lines, $where) {
    try {
      $sql = 'SELECT count(' . detalleFacturaCompraTableClass::ID . ') AS cantidad ' .
              ' FROM ' . detalleFacturaCompraTableClass::getNameTable();
              
    if (is_array($where) === true){
          foreach ($where as $field => $value){
              if (is_array($value)){
                  $sql = $sql . ' WHERE ' . $field . ' BETWEEN ' . ((is_numeric($value[0])) ? $value[0] : "'$value[0]'") . ' AND ' . ((is_numeric($value[1]) ? $value[1] : "'$value[1]'"));
              }  if(is_numeric($field)) {
                  $sql = $sql . ' WHERE ' . $value;
              } else {
                  $sql = $sql . ' WHERE ' . $field . ' = ' . ((is_numeric($value)) ? $value : "'$value'");
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
  
  public static function getNameDetalleFacturaCompra($id){
    try {
      $sql = 'SELECT ' . detalleFacturaCompraTableClass::ID .  ' As id'
             . '  FROM ' . detalleFacturaCompraTableClass::getNameTable() . '  '
             . '  WHERE ' . detalleFacturaCompraTableClass::ID . ' = :id';
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
  
   public static function getNameTotalPagar($idFacturar){
    try {
      $sql = 'SELECT ' . '  '. 'SUM ('. detalleFacturaCompraTableClass::VALOR_TOTAL  . ') ' .  ' As total'
             . '  FROM ' . detalleFacturaCompraTableClass::getNameTable() . '  ' 
             . ' WHERE ' . detalleFacturaCompraTableClass::FACTURA_COMPRA_ID . ' = ' . $idFacturar;
    
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
  
  
  
  
  
  public static function getTipoInsumo($idProducto){
    try {
      $sql = 'SELECT ' . '  ' . tipoProductoInsumoTableClass::getNameTable() . '.' . tipoProductoInsumoTableClass::ID  .  ' As id'
             . '  FROM ' . detalleFacturaCompraTableClass::getNameTable() . ' , ' . productoInsumoTableClass::getNameTable() . ' , ' . tipoProductoInsumoTableClass::getNameTable() . '  '
             . ' WHERE ' .  detalleFacturaCompraTableClass::getNameField(detalleFacturaCompraTableClass::DESCRIPCION) . ' = '. productoInsumoTableClass::getNameField(productoInsumoTableClass::ID) . ' AND ' .  productoInsumoTableClass::getNameField(productoInsumoTableClass::TIPO_PRODUCTO_INSUMO_ID) . ' = '. tipoProductoInsumoTableClass::getNameField(tipoProductoInsumoTableClass::ID) . ' AND '  . detalleFacturaCompraTableClass::getNameTable() . '.'. detalleFacturaCompraTableClass::DESCRIPCION . ' = ' . $idProducto;
    
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
  
 public static function getPlagaGanancia(){
    try {
      $idLote = session::getInstance()->getAttribute('totalUbicacion');
      $fechaInicial = session::getInstance()->getAttribute('totalRFecha1');
      $fechaFin = session::getInstance()->getAttribute('totalRFecha2');
      $sql = 'SELECT ' . '  '. ' ('. controlPlagaTableClass::getNameTable() .'.'. controlPlagaTableClass::CANTIDAD  . ') ' .  ' * ' . '  '. ' ('. detalleFacturaCompraTableClass::getNameTable() .'.'. detalleFacturaCompraTableClass::VALOR_UNIDAD  . ') '  . ' As total '
             . '  FROM ' . controlPlagaTableClass::getNameTable() . ',' . productoInsumoTableClass::getNameTable() . ',' . detalleFacturaCompraTableClass::getNameTable() . ',' . detalleFacturaVentaTableClass::getNameTable() . ',' . loteTableClass::getNameTable() . '  '  
             . ' WHERE ' .  controlPlagaTableClass::getNameField(controlPlagaTableClass::PRODUCTO_INSUMO_ID) . ' = '. productoInsumoTableClass::getNameField(productoInsumoTableClass::ID)  .'  '
             . ' AND ' .  detalleFacturaCompraTableClass::getNameField(detalleFacturaCompraTableClass::DESCRIPCION) . ' = '. productoInsumoTableClass::getNameField(productoInsumoTableClass::ID)  .'  '
             . ' AND ' .  controlPlagaTableClass::getNameField(controlPlagaTableClass::LOTE_ID) . ' = '. loteTableClass::getNameField(loteTableClass::ID)  .'  '
//             . ' AND ' . productoInsumoTableClass::getNameTable() . '.'. productoInsumoTableClass::ID . ' = ' . $idInsumo. '  '
             . ' AND ' . loteTableClass::getNameTable() . '.' . loteTableClass::UBICACION . ' = ' . "'" . $idLote . "'" . '  ' 
             . ' AND ' . '(' . detalleFacturaVentaTableClass::getNameField(detalleFacturaVentaTableClass::CREATED_AT) . ' BETWEEN ' . "'" . date(config::getFormatTimestamp(), strtotime($fechaInicial . ' 00:00:00')) . "'" . ' AND ' . "'" . date(config::getFormatTimestamp(), strtotime($fechaFin . ' 23:59:59')) . "'" . ' ) ';
              ;
    
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
  
  
  public static function getEnfermedadGanancia(){
    try {
//      $idInsumo = ;
      $idLote = session::getInstance()->getAttribute('totalUbicacion');
      $fechaInicial = session::getInstance()->getAttribute('totalRFecha1');
      $fechaFin = session::getInstance()->getAttribute('totalRFecha2');
      $sql = 'SELECT ' . '  '. ' ('. controlEnfermedadTableClass::getNameTable() .'.'. controlEnfermedadTableClass::CANTIDAD  . ') ' .  ' * ' . '  '. ' ('. detalleFacturaCompraTableClass::getNameTable() .'.'. detalleFacturaCompraTableClass::VALOR_UNIDAD  . ') '  . ' As total '
             . '  FROM ' . controlEnfermedadTableClass::getNameTable() . ',' . productoInsumoTableClass::getNameTable() . ',' . detalleFacturaCompraTableClass::getNameTable() . ',' . detalleFacturaVentaTableClass::getNameTable() . ',' . loteTableClass::getNameTable() . '  '  
             . ' WHERE ' .  controlEnfermedadTableClass::getNameField(controlEnfermedadTableClass::PRODUCTO_INSUMO_ID) . ' = '. productoInsumoTableClass::getNameField(productoInsumoTableClass::ID)  .'  '
             . ' AND ' .  detalleFacturaCompraTableClass::getNameField(detalleFacturaCompraTableClass::DESCRIPCION) . ' = '. productoInsumoTableClass::getNameField(productoInsumoTableClass::ID)  .'  '
             . ' AND ' .  controlEnfermedadTableClass::getNameField(controlEnfermedadTableClass::LOTE_ID) . ' = '. loteTableClass::getNameField(loteTableClass::ID)  .'  '
//             . ' AND ' . productoInsumoTableClass::getNameTable() . '.'. productoInsumoTableClass::ID . ' = ' . $idInsumo. '  '
             . ' AND ' . loteTableClass::getNameTable() . '.'. loteTableClass::UBICACION . ' = ' . "'" . $idLote . "'" . '  ' 
             . ' AND ' . '(' . detalleFacturaVentaTableClass::getNameField(detalleFacturaVentaTableClass::CREATED_AT) . ' BETWEEN ' . "'" . date(config::getFormatTimestamp(), strtotime($fechaInicial . ' 00:00:00')) . "'" . ' AND ' . "'" . date(config::getFormatTimestamp(), strtotime($fechaFin . ' 23:59:59')) . "'" . ' ) ';
              ;
    
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
  
  
   public static function getTrabajadorGanancia(){
    try {
      $idLote = session::getInstance()->getAttribute('totalUbicacion');
      $fechaInicial = session::getInstance()->getAttribute('totalRFecha1');
      $fechaFin = session::getInstance()->getAttribute('totalRFecha2');
  
      
      $sql = 'SELECT ' . '  '. 'SUM ('. detalleFacturaVentaTableClass::getNameTable() .'.'. detalleFacturaVentaTableClass::VALOR_TOTAL  . ') ' .  ' As total'
             . '  FROM ' . loteTableClass::getNameTable() . ' , ' . productoInsumoTableClass::getNameTable() . ' , ' . detalleFacturaVentaTableClass::getNameTable() . '  '
             . ' WHERE ' .  loteTableClass::getNameField(loteTableClass::PRODUCTO_INSUMO_ID) . ' = '. productoInsumoTableClass::getNameField(productoInsumoTableClass::ID)  .'  '
             . ' AND ' .  detalleFacturaVentaTableClass::getNameField(detalleFacturaVentaTableClass::DESCRIPCION) . ' = '. productoInsumoTableClass::getNameField(productoInsumoTableClass::ID)  .'  '
             . ' AND ' . '(' . detalleFacturaVentaTableClass::getNameField(detalleFacturaVentaTableClass::CREATED_AT) . ' BETWEEN ' . "'" . date(config::getFormatTimestamp(), strtotime($fechaInicial . ' 00:00:00')) . "'" . ' AND ' . "'" . date(config::getFormatTimestamp(), strtotime($fechaFin . ' 23:59:59')) . "'" . ' ) '
             . ' AND ' . loteTableClass::getNameTable() . '.'. loteTableClass::UBICACION . ' = ' . "'" . $idLote . "'" . '  ' ;
          
//     print_r($sql);
//            exit();
      $answer = model::getInstance()->prepare($sql);
            $answer->execute();
            $answer = $answer->fetchAll(PDO::FETCH_OBJ);
 return $answer[0]->total;
   } catch (Exception $exc) {
      throw $exc;
    }
    
  }
  
  
  public static function getVentaGanancia(){
    try {
      $idLote = session::getInstance()->getAttribute('totalUbicacion');
      $fechaInicial = session::getInstance()->getAttribute('totalRFecha1');
      $fechaFin = session::getInstance()->getAttribute('totalRFecha2');
  
      
      $sql = 'SELECT ' . '  '. 'SUM ('. detalleFacturaVentaTableClass::getNameTable() .'.'. detalleFacturaVentaTableClass::VALOR_TOTAL  . ') ' .  ' As total'
             . '  FROM ' . loteTableClass::getNameTable() . ' , ' . productoInsumoTableClass::getNameTable() . ' , ' . detalleFacturaVentaTableClass::getNameTable() . '  '
             . ' WHERE ' .  loteTableClass::getNameField(loteTableClass::PRODUCTO_INSUMO_ID) . ' = '. productoInsumoTableClass::getNameField(productoInsumoTableClass::ID)  .'  '
             . ' AND ' .  detalleFacturaVentaTableClass::getNameField(detalleFacturaVentaTableClass::DESCRIPCION) . ' = '. productoInsumoTableClass::getNameField(productoInsumoTableClass::ID)  .'  '
             . ' AND ' . '(' . detalleFacturaVentaTableClass::getNameField(detalleFacturaVentaTableClass::CREATED_AT) . ' BETWEEN ' . "'" . date(config::getFormatTimestamp(), strtotime($fechaInicial . ' 00:00:00')) . "'" . ' AND ' . "'" . date(config::getFormatTimestamp(), strtotime($fechaFin . ' 23:59:59')) . "'" . ' ) '
             . ' AND ' . loteTableClass::getNameTable() . '.'. loteTableClass::UBICACION . ' = ' . "'" . $idLote . "'" . '  ' ;
          
//     print_r($sql);
//            exit();
      $answer = model::getInstance()->prepare($sql);
            $answer->execute();
            $answer = $answer->fetchAll(PDO::FETCH_OBJ);
 return $answer[0]->total;
   } catch (Exception $exc) {
      throw $exc;
    }
    
  }
  
}
