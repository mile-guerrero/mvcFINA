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
  
 public static function getTotalPages($lines, $where){
    try {
      $sql = 'SELECT count(' . empresaTableClass::ID . ') AS cantidad '.
              ' FROM ' . empresaTableClass::getNameTable() .
              ' WHERE '. empresaTableClass::DELETED_AT . ' IS NULL ';
      
      if (is_array($where) === true){
          foreach ($where as $field => $value){
              if (is_array($value)){
                  $sql = $sql . ' AND ' . $field . ' BETWEEN ' . ((is_numeric($value[0])) ? $value[0] : "'$value[0]'") . ' AND ' . ((is_numeric($value[1]) ? $value[1] : "'$value[1]'"));
              }  if(is_numeric($field)) {
                  $sql = $sql . 'AND ' . $value;
              } else {
                  $sql = $sql . ' AND ' . ' = ' . ((is_numeric($value)) ? $value : "'$value'");
              }
          }
      }
      
      $answer = model::getInstance()->prepare($sql);
      $answer->execute();
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);
      return ceil($answer[0]->cantidad/$lines);
    }  catch (PDOException $exc){
       throw  $exc;
    }
  }
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
