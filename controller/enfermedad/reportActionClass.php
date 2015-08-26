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
* @return   enfermedadTableClass::ID retorna (integer),
            enfermedadTableClass::NOMBRE retorna  (string),
            enfermedadTableClass::descripcion retorna  (string),
            enfermedadTableClass::tratamiento retorna  (integer)
 * estos datos retornan en la variable $fields
*/
  public function execute() {
    try {
      $where = null;
      if (request::getInstance()->hasPost('report')) {
        $report = request::getInstance()->getPost('report');
        //Validar datos

        if (isset($report['nombre']) and $report['nombre'] !== null and $report['nombre'] !== '') {
          $where[] ='(' .  enfermedadTableClass::getNameField(enfermedadTableClass::NOMBRE) . ' LIKE ' . '\'' . $report['nombre'] . '%\'  '
              . 'OR ' . enfermedadTableClass::getNameField(enfermedadTableClass::NOMBRE) . ' LIKE ' . '\'%' . $report['nombre'] . '%\' '
              . 'OR ' . enfermedadTableClass::getNameField(enfermedadTableClass::NOMBRE) . ' LIKE ' . '\'%' . $report['nombre'].'\') ';       
              }//cierre del filtro nombre
              
        if (isset($report['descripcion']) and $report['descripcion'] !== null and $report['descripcion'] !== '') {
         $where[] = '(' . enfermedadTableClass::getNameField(enfermedadTableClass::DESCRIPCION) . ' LIKE ' . '\'' . $report['descripcion'] . '%\'  '
              . 'OR ' . enfermedadTableClass::getNameField(enfermedadTableClass::DESCRIPCION) . ' LIKE ' . '\'%' . $report['descripcion'] . '%\' '
              . 'OR ' . enfermedadTableClass::getNameField(enfermedadTableClass::DESCRIPCION) . ' LIKE ' . '\'%' . $report['descripcion'].'\') ';       
              }//cierre del filtro descripcion 
              
          if (isset($report['tratamiento']) and $report['tratamiento'] !== null and $report['tratamiento'] !== '') {
         $where[] = '(' . enfermedadTableClass::getNameField(enfermedadTableClass::TRATAMIENTO) . ' LIKE ' . '\'' . $report['tratamiento'] . '%\'  '
              . 'OR ' . enfermedadTableClass::getNameField(enfermedadTableClass::TRATAMIENTO) . ' LIKE ' . '\'%' . $report['tratamiento'] . '%\' '
              . 'OR ' . enfermedadTableClass::getNameField(enfermedadTableClass::TRATAMIENTO) . ' LIKE ' . '\'%' . $report['tratamiento'].'\') ';       
              }//cierre del filtro tratamiento       
       
        
        if (isset($report['fecha1']) and $report['fecha1'] !== null and $report['fecha1'] !== '' and (isset($report['fecha2']) and $report['fecha2'] !== null and $report['fecha2'] !== '')) {
          $where[enfermedadTableClass::CREATED_AT] = array(
          date(config::getFormatTimestamp(), strtotime($report['fecha1'] . ' 00:00:00')),
          date(config::getFormatTimestamp(), strtotime($report['fecha2'] . ' 23:59:59'))
          );
        }//cierre del filtro fecha1 y fecha2
          
      }//cierre del POST filter
      $this->mensaje = 'Informacion de la Enfermedad';
      $fields = array(
          enfermedadTableClass::ID,
          enfermedadTableClass::NOMBRE,
          enfermedadTableClass::DESCRIPCION,
          enfermedadTableClass::TRATAMIENTO,          
          enfermedadTableClass::CREATED_AT,
          enfermedadTableClass::UPDATED_AT
      );
      $orderBy = array(
         enfermedadTableClass::ID
      );
     
      $this->objEnfermedad = enfermedadTableClass::getAll($fields, true, $orderBy, 'ASC',null,null,$where);
 
       
 
      $this->defineView('index', 'enfermedad', session::getInstance()->getFormatOutput());
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
