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
 */
class reportActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      $where = null;
      if (request::getInstance()->hasPost('report')) {
        $report = request::getInstance()->getPost('report');
        //Validar datos

        if (isset($filter['nombre']) and $filter['nombre'] !== null and $filter['nombre'] !== '') {
          $where[] ='(' .  empresaTableClass::getNameField(empresaTableClass::NOMBRE) . ' LIKE ' . '\'' . $filter['nombre'] . '%\'  '
              . 'OR ' . empresaTableClass::getNameField(empresaTableClass::NOMBRE) . ' LIKE ' . '\'%' . $filter['nombre'] . '%\' '
              . 'OR ' . empresaTableClass::getNameField(empresaTableClass::NOMBRE) . ' LIKE ' . '\'%' . $filter['nombre'].'\') ';       
              }//cierre del filtro nombre
       
         if (isset($filter['direccion']) and $filter['direccion'] !== null and $filter['direccion'] !== '') {
          $where[] ='(' .  empresaTableClass::getNameField(empresaTableClass::DIRECCION) . ' LIKE ' . '\'' . $filter['direccion'] . '%\'  '
              . 'OR ' . empresaTableClass::getNameField(empresaTableClass::DIRECCION) . ' LIKE ' . '\'%' . $filter['direccion'] . '%\' '
              . 'OR ' . empresaTableClass::getNameField(empresaTableClass::DIRECCION) . ' LIKE ' . '\'%' . $filter['direccion'].'\') ';       
              }//cierre del filtro nombre
       
              
        
        if (isset($filter['fechaIni']) and $filter['fechaIni'] !== null and $filter['fechaIni'] !== '' and (isset($filter['fechaFin']) and $filter['fechaFin'] !== null and $filter['fechaFin'] !== '')) {
          $where[laborTableClass::CREATED_AT] = array(
          date(config::getFormatTimestamp(), strtotime($filter['fechaIni'] . ' 00:00:00')),
          date(config::getFormatTimestamp(), strtotime($filter['fechaFin'] . ' 23:59:59'))
          );
        }
      }
       
      $this->mensaje = 'Informacion de Empresa';
      $fields = array(
          empresaTableClass::ID,
          empresaTableClass::NOMBRE,
          empresaTableClass::DIRECCION,
          empresaTableClass::TELEFONO,
          empresaTableClass::EMAIL,
          empresaTableClass::CREATED_AT,
          empresaTableClass::UPDATED_AT,
		  empresaTableClass::UPDATED_AT
      );
      $orderBy = array(
         empresaTableClass::ID
      );
      $this->objEmpresa = empresaTableClass::getAll($fields, true, $orderBy, 'ASC',null,null,$where);
 
 
 
      $this->defineView('index', 'empresa', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo '<pre>';
      print_r($exc->getTrace());
      echo '</pre>';
    }
  }

}
