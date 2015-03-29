<?php

use mvc\model\modelClass as model;
use mvc\config\configClass as config;
/**
 * Description of ciudadTableClass
 *
 * @author Gonzalo Andres Bejarano, Elcy Milena Guerrero, Andres Eduardo Bahamon
 */
class ciudadTableClass extends ciudadBaseTableClass {

  public static function getNameCiudad($id){
    try {
      $sql = 'SELECT ' . ciudadTableClass::NOMBRE_CIUDAD .  ' As nombre  '
             . '  FROM ' . ciudadTableClass::getNameTable() . '  '
             . '  WHERE ' . ciudadTableClass::ID . ' = :id';
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
  
  
}
