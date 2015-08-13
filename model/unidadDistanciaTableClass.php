<?php

use mvc\model\modelClass as model;

/**
 * Description of unidadDistanciaTableClass
 *
 * @author Gonzalo Andres Bejarano, Elcy Milena Guerrero, Andres Eduardo Bahamon
 */
class unidadDistanciaTableClass extends unidadDistanciaBaseTableClass {
   public static function getNameUnidadDistancia($id){
    try {
      $sql = 'SELECT ' . unidadDistanciaTableClass::DESCRIPCION .  ' As des  '
             . '  FROM ' . unidadDistanciaTableClass::getNameTable() . '  '
             . '  WHERE ' . unidadDistanciaTableClass::ID . ' = :id';
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
