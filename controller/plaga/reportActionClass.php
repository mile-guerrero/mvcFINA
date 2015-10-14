<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

/**
* @author Gonzalo Andres Bejarano, Elcy Milena Guerrero, Andres Eduardo Bahamon 
* @date: fecha de inicio del desarrollo.
* @category: modulo de cliente.
*/
class reportActionClass extends controllerClass implements controllerActionInterface {

  /**
* @author: Gonzalo Andres Bejarano, Elcy Milena Guerrero, Andres Eduardo Bahamon .
* @date: fecha de inicio del desarrollo.
* @return   plagaTableClass::ID retorna (integer),
            plagaTableClass::NOMBRE retorna  (string),
            plagaTableClass::descripcion retorna  (string),
            plagaTableClass::tratamiento retorna  (integer)
 * estos datos retornan en la variable $fields
*/
  public function execute() {
    try {
      $where = null;
      if (request::getInstance()->hasPost('report')) {
        $report = request::getInstance()->getPost('report');
        //Validar datos

        if (isset($report['nombre']) and $report['nombre'] !== null and $report['nombre'] !== '') {
          $where[] ='(' .  plagaTableClass::getNameField(plagaTableClass::NOMBRE) . ' LIKE ' . '\'' . $report['nombre'] . '%\'  '
              . 'OR ' . plagaTableClass::getNameField(plagaTableClass::NOMBRE) . ' LIKE ' . '\'%' . $report['nombre'] . '%\' '
              . 'OR ' . plagaTableClass::getNameField(plagaTableClass::NOMBRE) . ' LIKE ' . '\'%' . $report['nombre'].'\') ';       
              }//cierre del filtro nombre
              
        if (isset($report['descripcion']) and $report['descripcion'] !== null and $report['descripcion'] !== '') {
         $where[] = '(' . plagaTableClass::getNameField(plagaTableClass::DESCRIPCION) . ' LIKE ' . '\'' . $report['descripcion'] . '%\'  '
              . 'OR ' . plagaTableClass::getNameField(plagaTableClass::DESCRIPCION) . ' LIKE ' . '\'%' . $report['descripcion'] . '%\' '
              . 'OR ' . plagaTableClass::getNameField(plagaTableClass::DESCRIPCION) . ' LIKE ' . '\'%' . $report['descripcion'].'\') ';       
              }//cierre del filtro descripcion 
              
          if (isset($report['tratamiento']) and $report['tratamiento'] !== null and $report['tratamiento'] !== '') {
         $where[] = '(' . plagaTableClass::getNameField(plagaTableClass::TRATAMIENTO) . ' LIKE ' . '\'' . $report['tratamiento'] . '%\'  '
              . 'OR ' . plagaTableClass::getNameField(plagaTableClass::TRATAMIENTO) . ' LIKE ' . '\'%' . $report['tratamiento'] . '%\' '
              . 'OR ' . plagaTableClass::getNameField(plagaTableClass::TRATAMIENTO) . ' LIKE ' . '\'%' . $report['tratamiento'].'\') ';       
              }//cierre del filtro tratamiento       
       
        
        if (isset($report['fecha1']) and $report['fecha1'] !== null and $report['fecha1'] !== '' and (isset($report['fecha2']) and $report['fecha2'] !== null and $report['fecha2'] !== '')) {
          $where[plagaTableClass::CREATED_AT] = array(
          date(config::getFormatTimestamp(), strtotime($report['fecha1'] . ' 00:00:00')),
          date(config::getFormatTimestamp(), strtotime($report['fecha2'] . ' 23:59:59'))
          );
        }//cierre del filtro fecha1 y fecha2
          
      }//cierre del POST filter
      $this->mensaje = 'Informacion de la Plaga';
      $fields = array(
          plagaTableClass::ID,
          plagaTableClass::NOMBRE,
          plagaTableClass::DESCRIPCION,
          plagaTableClass::TRATAMIENTO,          
          plagaTableClass::CREATED_AT,
          plagaTableClass::UPDATED_AT
      );
      $orderBy = array(
         plagaTableClass::ID
      );
     
      $this->objPlaga = plagaTableClass::getAll($fields, false, $orderBy, 'ASC', null, null,$where);
 
       
 
      $this->defineView('index', 'plaga', session::getInstance()->getFormatOutput());
    } //cierre del try
     catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo '<pre>';
      print_r($exc->getTrace());
      echo '</pre>';
    }//cierre del catch
  }//cierre de la funcion execute

}//cierre de la clase
