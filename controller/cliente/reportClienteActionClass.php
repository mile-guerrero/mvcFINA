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
class reportClienteActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      $where = null;
      if (request::getInstance()->hasPost('report')) {
        $report = request::getInstance()->getPost('report');
        //Validar datos

        if (isset($report['nombre']) and $report['nombre'] !== null and $report['nombre'] !== '') {
          $where[clienteTableClass::NOMBRE] = $report['nombre'];
        }
        if (isset($report['ciudad']) and $report['ciudad'] !== null and $report['ciudad'] !== '') {
          $where[clienteTableClass::ID_CIUDAD] = $report['ciudad'];
        }
        if (isset($report['fecha1']) and $report['fecha1'] !== null and $report['fecha1'] !== '' and (isset($report['fecha2']) and $report['fecha2'] !== null and $report['fecha2'] !== '')) {
          $where[clienteTableClass::CREATED_AT] = array(
          date(config::getFormatTimestamp(), strtotime($report['fecha1'] . ' 00:00:00')),
          date(config::getFormatTimestamp(), strtotime($report['fecha2'] . ' 23:59:59'))
          );
        }
      }
      $this->mensaje = 'Informacion de Clientes';
      $fields = array(
          clienteTableClass::ID,
          clienteTableClass::NOMBRE,
          clienteTableClass::APELLIDO,
          clienteTableClass::DOCUMENTO,
          clienteTableClass::DIRECCION,
          clienteTableClass::TELEFONO,          
          clienteTableClass::CREATED_AT,
          clienteTableClass::UPDATED_AT
      );
      $orderBy = array(
         clienteTableClass::ID
      );
      $this->objC = clienteTableClass::getAll($fields, true, $orderBy, 'ASC',null,null,$where);
 
       $fields = array(
          ciudadTableClass::ID,
          ciudadTableClass::NOMBRE_CIUDAD,
          ciudadTableClass::HABITANTES
      );
      $orderBy = array(
         ciudadTableClass::ID
      );
      $this->objCC = ciudadTableClass::getAll($fields, false, $orderBy, 'ASC');
 
      $fields = array(
          tipoIdTableClass::ID,
          tipoIdTableClass::DESCRIPCION
      );
      $orderBy = array(
         tipoIdTableClass::ID
      );
      
      $this->objCTI = tipoIdTableClass::getAll($fields, false, $orderBy, 'ASC');
 
      $this->defineView('indexCliente', 'cliente', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo '<pre>';
      print_r($exc->getTrace());
      echo '</pre>';
    }
  }

}
