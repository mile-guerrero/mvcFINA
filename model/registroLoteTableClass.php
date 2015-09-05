<?php

use mvc\model\modelClass as model;
use mvc\config\configClass as config;

/**
 * Description of registroLoteTableClass
 *
 * @author Gonzalo Andres Bejarano, Elcy Milena Guerrero, Andres Eduardo Bahamon
 */
class registroLoteTableClass extends registroLoteBaseTableClass {
  
  
   public static function getNamePlagaNombre($id){
    try {
      $sql = 'SELECT ' . plagaTableClass::getNameTable() . '.'. plagaTableClass::NOMBRE .  ' As nombre  '
             . '  FROM ' . registroLoteTableClass::getNameTable() . ','. productoInsumoTableClass::getNameTable() . ','. historialTableClass::getNameTable() . ','. plagaTableClass::getNameTable() . ' '
             . '  WHERE ' . historialTableClass::getNameField(historialTableClass::PRODUCTO_INSUMO_ID) .  ' = ' . productoInsumoTableClass::getNameField(productoInsumoTableClass::ID). '  AND ' . historialTableClass::getNameField(historialTableClass::PLAGA_ID) .  ' = ' . plagaTableClass::getNameField(plagaTableClass::ID). '  AND ' . registroLoteTableClass::getNameField(registroLoteTableClass::PRODUCTO_INSUMO_ID) .  ' = ' . productoInsumoTableClass::getNameField(productoInsumoTableClass::ID) ;
//      print_r($sql);
//     exit();
      
      $answer = model::getInstance()->prepare($sql);
            $answer->execute();
            $answer = $answer->fetchAll(PDO::FETCH_OBJ);

      return $answer[0]->nombre;
   } catch (Exception $exc) {
      throw $exc;
    }
  }
  
   public static function getNamePlagaDescripcion($id){
    try {
      $sql = 'SELECT ' . plagaTableClass::getNameTable() . '.'. plagaTableClass::DESCRIPCION .  ' As descripcion  '
             . '  FROM ' . registroLoteTableClass::getNameTable() . ','. productoInsumoTableClass::getNameTable() . ','. historialTableClass::getNameTable() . ','. plagaTableClass::getNameTable() . ' '
             . '  WHERE ' . historialTableClass::getNameField(historialTableClass::PRODUCTO_INSUMO_ID) .  ' = ' . productoInsumoTableClass::getNameField(productoInsumoTableClass::ID). '  AND ' . historialTableClass::getNameField(historialTableClass::PLAGA_ID) .  ' = ' . plagaTableClass::getNameField(plagaTableClass::ID). '  AND ' . registroLoteTableClass::getNameField(registroLoteTableClass::PRODUCTO_INSUMO_ID) .  ' = ' . productoInsumoTableClass::getNameField(productoInsumoTableClass::ID) ;
//      print_r($sql);
//     exit();
      
      $answer = model::getInstance()->prepare($sql);
            $answer->execute();
            $answer = $answer->fetchAll(PDO::FETCH_OBJ);

      return $answer[0]->descripcion;
   } catch (Exception $exc) {
      throw $exc;
    }
  }
  
  public static function getNamePlagaTratamiento($id){
    try {
      $sql = 'SELECT ' . plagaTableClass::getNameTable() . '.'. plagaTableClass::TRATAMIENTO .  ' As tratamiento  '
             . '  FROM ' . registroLoteTableClass::getNameTable() . ','. productoInsumoTableClass::getNameTable() . ','. historialTableClass::getNameTable() . ','. plagaTableClass::getNameTable() . ' '
             . '  WHERE ' . historialTableClass::getNameField(historialTableClass::PRODUCTO_INSUMO_ID) .  ' = ' . productoInsumoTableClass::getNameField(productoInsumoTableClass::ID). '  AND ' . historialTableClass::getNameField(historialTableClass::PLAGA_ID) .  ' = ' . plagaTableClass::getNameField(plagaTableClass::ID). '  AND ' . registroLoteTableClass::getNameField(registroLoteTableClass::PRODUCTO_INSUMO_ID) .  ' = ' . productoInsumoTableClass::getNameField(productoInsumoTableClass::ID) ;
//      print_r($sql);
//     exit();
      
      $answer = model::getInstance()->prepare($sql);
            $answer->execute();
            $answer = $answer->fetchAll(PDO::FETCH_OBJ);

      return $answer[0]->tratamiento;
   } catch (Exception $exc) {
      throw $exc;
    }
  }
  
  
  
   public static function getNameEnfermedadNombre($id){
    try {
      $sql = 'SELECT ' . enfermedadTableClass::getNameTable() . '.'. enfermedadTableClass::NOMBRE .  ' As nombre  '
             . '  FROM ' . registroLoteTableClass::getNameTable() . ','. productoInsumoTableClass::getNameTable() . ','. historialTableClass::getNameTable() . ','. enfermedadTableClass::getNameTable() . ' '
             . '  WHERE ' . historialTableClass::getNameField(historialTableClass::PRODUCTO_INSUMO_ID) .  ' = ' . productoInsumoTableClass::getNameField(productoInsumoTableClass::ID). '  AND ' . historialTableClass::getNameField(historialTableClass::ENFERMEDAD_ID) .  ' = ' . enfermedadTableClass::getNameField(enfermedadTableClass::ID). '  AND ' . registroLoteTableClass::getNameField(registroLoteTableClass::PRODUCTO_INSUMO_ID) .  ' = ' . productoInsumoTableClass::getNameField(productoInsumoTableClass::ID) ;
//      print_r($sql);
//     exit();
      
      $answer = model::getInstance()->prepare($sql);
            $answer->execute();
            $answer = $answer->fetchAll(PDO::FETCH_OBJ);

      return $answer[0]->nombre;
   } catch (Exception $exc) {
      throw $exc;
    }
  }
  
   public static function getNameEnfermedadDescripcion($id){
    try {
       $sql = 'SELECT ' . enfermedadTableClass::getNameTable() . '.'. enfermedadTableClass::DESCRIPCION .  ' As descripcion  '
             . '  FROM ' . registroLoteTableClass::getNameTable() . ','. productoInsumoTableClass::getNameTable() . ','. historialTableClass::getNameTable() . ','. enfermedadTableClass::getNameTable() . ' '
             . '  WHERE ' . historialTableClass::getNameField(historialTableClass::PRODUCTO_INSUMO_ID) .  ' = ' . productoInsumoTableClass::getNameField(productoInsumoTableClass::ID). '  AND ' . historialTableClass::getNameField(historialTableClass::ENFERMEDAD_ID) .  ' = ' . enfermedadTableClass::getNameField(enfermedadTableClass::ID). '  AND ' . registroLoteTableClass::getNameField(registroLoteTableClass::PRODUCTO_INSUMO_ID) .  ' = ' . productoInsumoTableClass::getNameField(productoInsumoTableClass::ID) ;
//      print_r($sql);
//     exit();
      
      $answer = model::getInstance()->prepare($sql);
            $answer->execute();
            $answer = $answer->fetchAll(PDO::FETCH_OBJ);

      return $answer[0]->descripcion;
   } catch (Exception $exc) {
      throw $exc;
    }
  }
  
  public static function getNameEnfermedadTratamiento($id){
    try {
      
       $sql = 'SELECT ' . enfermedadTableClass::getNameTable() . '.'. enfermedadTableClass::TRATAMIENTO .  ' As tratamiento  '
             . '  FROM ' . registroLoteTableClass::getNameTable() . ','. productoInsumoTableClass::getNameTable() . ','. historialTableClass::getNameTable() . ','. enfermedadTableClass::getNameTable() . ' '
             . '  WHERE ' . historialTableClass::getNameField(historialTableClass::PRODUCTO_INSUMO_ID) .  ' = ' . productoInsumoTableClass::getNameField(productoInsumoTableClass::ID). '  AND ' . historialTableClass::getNameField(historialTableClass::ENFERMEDAD_ID) .  ' = ' . enfermedadTableClass::getNameField(enfermedadTableClass::ID). '  AND ' . registroLoteTableClass::getNameField(registroLoteTableClass::PRODUCTO_INSUMO_ID) .  ' = ' . productoInsumoTableClass::getNameField(productoInsumoTableClass::ID) ;
//      print_r($sql);
//     exit();
     
      
      $answer = model::getInstance()->prepare($sql);
            $answer->execute();
            $answer = $answer->fetchAll(PDO::FETCH_OBJ);

      return $answer[0]->tratamiento;
   } catch (Exception $exc) {
      throw $exc;
    }
  }
  
  
  
   public static function getNameTotal($id){
    try {
      $sql = 'SELECT ' . '  '. 'SUM ('. registroLoteTableClass::PRODUCCION  . ') ' .  ' As total'
             . '  FROM ' . registroLoteTableClass::getNameTable() . '  ' 
             . ' WHERE ' . registroLoteTableClass::PRODUCTO_INSUMO_ID . ' = ' . $id;
    
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

  public static function getProduccion($ubicacion, $fechaInicial, $fechaFin) {
    try {
      $sql = 'SELECT ' . registroLoteTableClass::PRODUCCION . ' AS ' . ' produccion ' . ' ' .
              ' FROM ' . registroLoteTableClass::getNameTable() .
              ' WHERE ' . '(' . registroLoteTableClass::getNameField(registroLoteTableClass::UBICACION) . ' LIKE ' . '\'' . $ubicacion . '%\'  '
              . 'OR ' . registroLoteTableClass::getNameField(registroLoteTableClass::UBICACION) . ' LIKE ' . '\'%' . $ubicacion . '%\' '
              . 'OR ' . registroLoteTableClass::getNameField(registroLoteTableClass::UBICACION) . ' LIKE ' . '\'%' . $ubicacion . '\') '
              . ' AND ' . '(' . registroLoteTableClass::getNameField(registroLoteTableClass::CREATED_AT) . ' BETWEEN ' . "'" . date(config::getFormatTimestamp(), strtotime($fechaInicial . ' 00:00:00')) . "'" . ' AND ' . "'" . date(config::getFormatTimestamp(), strtotime($fechaFin . ' 23:59:59')) . "'" . ' ) ';
//           print_r($sql);  
//          exit();
      $answer = model::getInstance()->prepare($sql);
      $answer->execute();
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);
//    for($i=0;$i<count($answer);$i++) {
//      return ($answer[$i]);
//      print_r($answer[$i]); 
//      echo '<br />';
//}

//      foreach($answer as $key){
//			print_r($key) ;
//        echo '<br>';
//	  }
//      print_r($answer);
//          exit();
      return $answer[0]->produccion;
    } catch (PDOException $exc) {
      throw $exc;
    }
  }

  public static function getFecha($ubicacion, $fechaInicial, $fechaFin) {
    try {
      $sql = 'SELECT ' . registroLoteTableClass::CREATED_AT . ' AS ' . ' fecha ' . ' ' .
              ' FROM ' . registroLoteTableClass::getNameTable() .
              ' WHERE ' . '(' . registroLoteTableClass::getNameField(registroLoteTableClass::UBICACION) . ' LIKE ' . '\'' . $ubicacion . '%\'  '
              . 'OR ' . registroLoteTableClass::getNameField(registroLoteTableClass::UBICACION) . ' LIKE ' . '\'%' . $ubicacion . '%\' '
              . 'OR ' . registroLoteTableClass::getNameField(registroLoteTableClass::UBICACION) . ' LIKE ' . '\'%' . $ubicacion . '\') '
              . ' AND ' . '(' . registroLoteTableClass::getNameField(registroLoteTableClass::CREATED_AT) . ' BETWEEN ' . "'" . date(config::getFormatTimestamp(), strtotime($fechaInicial . ' 00:00:00')) . "'" . ' AND ' . "'" . date(config::getFormatTimestamp(), strtotime($fechaFin . ' 23:59:59')) . "'" . ' ) ';

      $answer = model::getInstance()->prepare($sql);
      $answer->execute();
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);
      // echo count($answer);
//      for($i=0;$i<count($answer);$i++) {
//        return ($answer[$i]);
////      print_r($answer[$i]); 
////      echo '<br />';
//}
      
//      foreach($answer as $key){
//		print_r($key) ;
//        echo '<br>';
//	  }
//      echo '<br>';
//      print_r($answer);
//      exit();
      return $answer[0]->fecha;
    } catch (PDOException $exc) {
      throw $exc;
    }
  }

//  public static function getNumeros() {
//        try {
//            $sql = 'SELECT count(' . registroLoteTableClass::ID . ') AS cantidad ' .
//                    ' FROM ' . registroLoteTableClass::getNameTable() .
//                    ' WHERE ' . registroLoteTableClass::DELETED_AT . ' IS NULL ';
//            $answer = model::getInstance()->prepare($sql);
//            $answer->execute();
//            $answer = $answer->fetchAll(PDO::FETCH_OBJ);
//      return $answer[0]->cantidad;
//        } catch (PDOException $exc) {
//            throw $exc;
//        }
//    }
//    
//     public static function getProduccion($ubicacion) {
//        try {
//            $sql = 'SELECT ' . registroLoteTableClass::PRODUCCION .  ' AS '  .' produccion '  . ' ' .
//                    ' FROM ' . registroLoteTableClass::getNameTable() .
//                    ' WHERE ' . registroLoteTableClass::DELETED_AT . ' IS NULL ' .  ' AND ' .  '(' . registroLoteTableClass::getNameField(registroLoteTableClass::UBICACION) . ' LIKE ' . '\'' . $ubicacion . '%\'  '
//                      . 'OR ' . registroLoteTableClass::getNameField(registroLoteTableClass::UBICACION) . ' LIKE ' . '\'%' . $ubicacion . '%\' '
//                      . 'OR ' . registroLoteTableClass::getNameField(registroLoteTableClass::UBICACION) . ' LIKE ' . '\'%' . $ubicacion . '\') ';
////           print_r($sql);  
////          exit();
//            $answer = model::getInstance()->prepare($sql);
//            $answer->execute();
//            $answer = $answer->fetchAll(PDO::FETCH_OBJ);
//      return $answer[0]->produccion;
//        } catch (PDOException $exc) {
//            throw $exc;
//        }
//    }
//  
//  public static function getNameLote($id) {
//    try {
//      $sql = 'SELECT ' . registroLoteTableClass::UBICACION . ' As descripcion  '
//              . '  FROM ' . registroLoteTableClass::getNameTable() . '  '
//              . '  WHERE ' . registroLoteTableClass::ID . ' = :id';
//      $params = array(
//          ':id' => $id
//      );
//      $answer = model::getInstance()->prepare($sql);
//      $answer->execute($params);
//      $answer = $answer->fetchAll(PDO::FETCH_OBJ);
//      return $answer[0]->descripcion;
//    } catch (Exception $exc) {
//      throw $exc;
//    }
//  }
//  
//   public static function getNameFechaRiego($id) {
//    try {
//      $sql = 'SELECT ' . registroLoteTableClass::FECHA_RIEGO . ' As fecha_riego  '
//              . '  FROM ' . registroLoteTableClass::getNameTable() . '  '
//              . '  WHERE ' . registroLoteTableClass::ID . ' = :id';
//      $params = array(
//          ':id' => $id
//      );
//      $answer = model::getInstance()->prepare($sql);
//      $answer->execute($params);
//      $answer = $answer->fetchAll(PDO::FETCH_OBJ);
//      return $answer[0]->fecha_riego;
//    } catch (Exception $exc) {
//      throw $exc;
//    }
//  }
//
//   public static function getTotalPages($lines, $where) {
//    try {
//      $sql = 'SELECT count(' . registroLoteTableClass::ID . ') AS cantidad ' .
//              ' FROM ' . registroLoteTableClass::getNameTable() .
//              ' WHERE ' . registroLoteTableClass::DELETED_AT . ' IS NULL ';
//      
//      if (is_array($where) === true){
//          foreach ($where as $field => $value){
//              if (is_array($value)){
//                  $sql = $sql . ' AND ' . $field . ' BETWEEN ' . ((is_numeric($value[0])) ? $value[0] : "'$value[0]'") . ' AND ' . ((is_numeric($value[1]) ? $value[1] : "'$value[1]'"));
//              }  if(is_numeric($field)) {
//                  $sql = $sql . 'AND ' . $value;
//              } else {
//                  $sql = $sql . ' AND ' . $field . ' = ' . ((is_numeric($value)) ? $value : "'$value'");
//              }
//          }
//      }
//      
//      $answer = model::getInstance()->prepare($sql);
//      $answer->execute();
//      $answer = $answer->fetchAll(PDO::FETCH_OBJ);
//      return ceil($answer[0]->cantidad / $lines);
//    } catch (PDOException $exc) {
//      throw $exc;
//    }
//  }
//
  public static function regitroLoteInsert($ubicacion, $fechaRiego, $numero, $insumo, $produccion, $unidadMedida) {
    try {
      $sql = 'INSERT INTO' . '  ' . registroLoteTableClass::getNameTable() . ' (' . registroLoteTableClass::UBICACION . ',' . registroLoteTableClass::FECHA_RIEGO . ',' . registroLoteTableClass::PRODUCTO_INSUMO_ID . ',' . registroLoteTableClass::NUMERO_PLANTULAS . ',' . registroLoteTableClass::PRODUCCION . ',' . registroLoteTableClass::UNIDAD_MEDIDA_ID . ' ) '
              . ' VALUES (' . "'" . $ubicacion . "'" . ',' . "'" . $fechaRiego . "'" . ',' . $insumo . ',' . $numero . ',' . $produccion . ',' . $unidadMedida . ' )';


      model::getInstance()->beginTransaction();
      model::getInstance()->exec($sql);
      model::getInstance()->commit();
    } catch (PDOException $exc) {
      throw $exc;
    }
  }

//
//  public static function loteupdateMas($id, $fechaSiembra, $fechaRiego, $numero, $insumo, $presupuesto, $produccion, $unidadMedida) {
//    try {
//
//      $sql = 'UPDATE ' . '  ' . registroLoteTableClass::getNameTable() . ' SET ' . ' ' . registroLoteTableClass::FECHA_INICIO_SIEMBRA . '=' . "'" . $fechaSiembra . "'" . ',' . registroLoteTableClass::FECHA_RIEGO . '=' . "'" . $fechaRiego . "'" . ',' . registroLoteTableClass::NUMERO_PLANTULAS . '=' . $numero . ',' . registroLoteTableClass::PRODUCTO_INSUMO_ID . '=' . $insumo . ',' . registroLoteTableClass::PRESUPUESTO . '=' . $presupuesto . ',' . registroLoteTableClass::PRODUCCION . '=' . $produccion . ',' . registroLoteTableClass::UNIDAD_MEDIDA_ID . '=' . $unidadMedida . '  '
//              . ' WHERE ' . registroLoteTableClass::ID . '=' . $id . ' ';
//
//
//      model::getInstance()->beginTransaction();
//      model::getInstance()->exec($sql);
//      model::getInstance()->commit();
//    } catch (PDOException $exc) {
//      throw $exc;
//    }
//  }
}
