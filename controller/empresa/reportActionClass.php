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

        if (isset($report['nombre']) and $report['nombre'] !== null and $report['nombre'] !== '') {
          $where[empresaTableClass::NOMBRE] = $report['nombre'];
        }
      
        if (isset($report['fecha1']) and $report['fecha1'] !== null and $report['fecha1'] !== '' and (isset($report['fecha2']) and $report['fecha2'] !== null and $report['fecha2'] !== '')) {
          $where[empresaTableClass::CREATED_AT] = array(
          date(config::getFormatTimestamp(), strtotime($report['fecha1'] . ' 00:00:00')),
          date(config::getFormatTimestamp(), strtotime($report['fecha2'] . ' 23:59:59'))
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
      $this->objCC = empresaTableClass::getAll($fields, true, $orderBy, 'ASC',null,null,$where);
 
 
 
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
