<?php use mvc\model\modelClass as model;

/**
 * Description of credencialTableClass
 *
 * @author 
 */
class empresaTableClass extends empresaBaseTableClass {
  
  public static function getNameEmpresa($id){
    try {
      $sql = 'SELECT ' . empresaTableClass::NOMBRE .  ' As nombre  '
             . '  FROM ' . empresaTableClass::getNameTable() . '  '
             . '  WHERE ' . empresaTableClass::ID . ' = :id';
      $params = array(
          ':id' => $id
      );
      $answer = model::getInstance()->prepare($sql);
      $answer->execute($params);
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);
      return $answer[0]->nombre;
      
    } catch (Exception $exc) {
      throw $exc;
    }
    
  }
  
//  public static function getTotalPages($lines){
//    try {
//      $sql = 'SELECT count(' . proveedorTableClass::ID . ') AS cantidad '.
//              ' FROM ' . proveedorTableClass::getNameTable() .
//              ' WHERE '. proveedorTableClass::DELETED_AT . ' IS NULL ';
//      $answer = model::getInstance()->prepare($sql);
//      $answer->execute();
//      $answer = $answer->fetchAll(PDO::FETCH_OBJ);
//      return ceil($answer[0]->cantidad/$lines);
//    }  catch (PDOException $exc){
//       throw  $exc;
//    }
//  }
//public static function getNameProveedor($id){
//    try {
//      $sql = 'SELECT ' . proveedorTableClass::NOMBRE .  ' As nombre  '
//             . '  FROM ' . proveedorTableClass::getNameTable() . '  '
//             . '  WHERE ' . proveedorTableClass::ID . ' = :id';
//      $params = array(
//          ':id' => $id
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
//    
//    
//  }
}
