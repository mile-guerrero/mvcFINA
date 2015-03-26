<?php


use mvc\model\modelClass as model;
use mvc\config\configClass as config;

/**
 * Description of credencialTableClass
 *
 * @author gonzalo bejarano
 */
class trabajadorTableClass extends trabajadorBaseTableClass {

  public static function getNameTrabajador($id){
    try {
      $sql = 'SELECT ' . trabajadorTableClass::NOMBRET .  ' As descripcion  '
             . '  FROM ' . trabajadorTableClass::getNameTable() . '  '
             . '  WHERE ' . trabajadorTableClass::ID . ' = :id';
      $params = array(
          ':id' => $id
      );
      $answer = model::getInstance()->prepare($sql);
      $answer->execute($params);
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);
      return $answer[0]->descripcion;
      
    } catch (Exception $exc) {
      throw $exc;
    }
    
  }
}
