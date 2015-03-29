<?php

use mvc\model\modelClass as model;

/**
 * Description of unidadMedidaTableClass
 *
 * @author Gonzalo Andres Bejarano, Elcy Milena Guerrero, Andres Eduardo Bahamon
 */
class unidadMedidaTableClass extends unidadMedidaBaseTableClass {
  public static function getNameUnidadMedida($id){
    try {
      $sql = 'SELECT ' . unidadMedidaTableClass::DESCRIPCION .  ' As des  '
             . '  FROM ' . unidadMedidaTableClass::getNameTable() . '  '
             . '  WHERE ' . unidadMedidaTableClass::ID . ' = :id';
      $params = array(
          ':id' => $id
      );
      $answer = model::getInstance()->prepare($sql);
      $answer->execute($params);
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);
      return $answer[0]->des;
      
    } catch (Exception $exc) {
      throw $exc;
    }
    
  }
}
