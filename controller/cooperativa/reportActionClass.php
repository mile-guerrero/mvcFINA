<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

/**
 * Description of ejemploClass
 *
 * @author Gonzalo Andres Bejarano, Elcy Milena Guerrero, Andres Eduardo Bahamon
 * @date: fecha de inicio del desarrollo.
 * @static: se define si la clase es de tipo estatica.
 * @category: modulo cooperativa
 * 

 */
class reportActionClass extends controllerClass implements controllerActionInterface {
/**
  * @author: Gonzalo Andres Bejarano, Elcy Milena Guerrero, Andres Eduardo Bahamon
  * @date: fecha de inicio del desarrollo.
  * @return cooperativaTableClass::ID retorna $id(integer),
  *        cooperativaTableClass::NOMBRE retorna $nombre(string),
  *        cooperativaTableClass::DESCRIPCION retorna $descripcion(string),
  *        cooperativaTableClass::DIRECCION retorna $direccion(string),
  *        cooperativaTableClass::TELEFONO retorna $telefono(integer),  
  *        cooperativaTableClass::ID_CIUDAD retorna $id_ciudad(integer),
  *        cooperativaTableClass::CREATED_AT,
  *        cooperativaTableClass::UPDATED_AT,
  *	       cooperativaTableClass::UPDATED_AT
  * estos datos retornan en la variable $fields
  */
  public function execute() {
    try {
      $where = null;
      if (request::getInstance()->hasPost('report')) {
        $report = request::getInstance()->getPost('report');
        //Validar datos

       if (isset($report['nombre']) and $report['nombre'] !== null and $report['nombre'] !== '') {
         $where[] ='(' .  cooperativaTableClass::getNameField(cooperativaTableClass::NOMBRE) . ' LIKE ' . '\'' . $report['nombre'] . '%\'  '
              . 'OR ' . cooperativaTableClass::getNameField(cooperativaTableClass::NOMBRE) . ' LIKE ' . '\'%' . $report['nombre'] . '%\' '
              . 'OR ' . cooperativaTableClass::getNameField(cooperativaTableClass::NOMBRE) . ' LIKE ' . '\'%' . $report['nombre'].'\') ';       
              }//cierre del filtro nombre
              
        if (isset($report['descripcion']) and $report['descripcion'] !== null and $report['descripcion'] !== '') {
           $where[] ='(' .  cooperativaTableClass::getNameField(cooperativaTableClass::DESCRIPCION) . ' LIKE ' . '\'' . $report['nombre'] . '%\'  '
              . 'OR ' . cooperativaTableClass::getNameField(cooperativaTableClass::DESCRIPCION) . ' LIKE ' . '\'%' . $report['nombre'] . '%\' '
              . 'OR ' . cooperativaTableClass::getNameField(cooperativaTableClass::DESCRIPCION) . ' LIKE ' . '\'%' . $report['nombre'].'\') ';       
              }//cierre del filtro 
              
        if (isset($report['ciudad']) and $report['ciudad'] !== null and $report['ciudad'] !== '') {
          $where[cooperativaTableClass::ID_CIUDAD] = $report['ciudad'];
        }
        
        if (isset($report['fechaIni']) and $report['fechaIni'] !== null and $report['fechaIni'] !== '' and (isset($report['fechaFin']) and $filter['fechaFin'] !== null and $filter['fechaFin'] !== '')) {
          $where[cooperativaTableClass::CREATED_AT] = array(
          date(config::getFormatTimestamp(), strtotime($report['fechaIni'] . ' 00:00:00')),
          date(config::getFormatTimestamp(), strtotime($report['fechaFin'] . ' 23:59:59'))
          );
        }
      }
      $this->mensaje = 'Informacion de la Cooperativa';
      $fields = array(
          cooperativaTableClass::ID,
          cooperativaTableClass::NOMBRE,
          cooperativaTableClass::DESCRIPCION,
          cooperativaTableClass::DIRECCION,
          cooperativaTableClass::TELEFONO,   
          cooperativaTableClass::ID_CIUDAD,
          cooperativaTableClass::CREATED_AT,
          cooperativaTableClass::UPDATED_AT
      );
      $orderBy = array(
         cooperativaTableClass::ID
      );
      
      
      $this->objCooperativa = cooperativaTableClass::getAll($fields, true, $orderBy, 'ASC',null,null,$where);
 
       $fields = array(
          ciudadTableClass::ID,
          ciudadTableClass::NOMBRE_CIUDAD,
      );
      $orderBy = array(
         ciudadTableClass::ID
      );
      $this->objCiudad = ciudadTableClass::getAll($fields, false, $orderBy, 'ASC');
 
      $this->defineView('index', 'cooperativa', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo '<pre>';
      print_r($exc->getTrace());
      echo '</pre>';
    }
  }

}
