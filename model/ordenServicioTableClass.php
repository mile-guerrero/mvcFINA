<?php

use mvc\model\modelClass as model;
use mvc\config\configClass as config;

/**
 * Description of ordenServicioTableClass
 *
 * @author Gonzalo Andres Bejarano, Elcy Milena Guerrero, Andres Eduardo Bahamon
 */
class ordenServicioTableClass extends ordenServicioBaseTableClass {
  
  public static function getTipoInsumo($idProducto){
    try {
      $sql = 'SELECT ' . '  ' . tipoProductoInsumoTableClass::getNameTable() . '.' . tipoProductoInsumoTableClass::ID  .  ' As id'
             . '  FROM ' . ordenServicioTableClass::getNameTable() . ' , ' . productoInsumoTableClass::getNameTable() . ' , ' . tipoProductoInsumoTableClass::getNameTable() . '  '
             . ' WHERE ' .  ordenServicioTableClass::getNameField(ordenServicioTableClass::PRODUCTO_INSUMO_ID) . ' = '. productoInsumoTableClass::getNameField(productoInsumoTableClass::ID) . ' AND ' .  productoInsumoTableClass::getNameField(productoInsumoTableClass::TIPO_PRODUCTO_INSUMO_ID) . ' = '. tipoProductoInsumoTableClass::getNameField(tipoProductoInsumoTableClass::ID) . ' AND '  . ordenServicioTableClass::getNameTable() . '.'. ordenServicioTableClass::PRODUCTO_INSUMO_ID . ' = ' . $idProducto;
    
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
  
  public static function getTotalPages($lines, $where) {
    try {
      $sql = 'SELECT count(' . ordenServicioTableClass::ID . ') AS cantidad ' .
              ' FROM ' . ordenServicioTableClass::getNameTable() ;
      
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
}
