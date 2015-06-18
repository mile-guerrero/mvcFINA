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
class reportClienteActionClass extends controllerClass implements controllerActionInterface {

  /**
* @author: Gonzalo Andres Bejarano, Elcy Milena Guerrero, Andres Eduardo Bahamon .
* @date: fecha de inicio del desarrollo.
* @return   clienteTableClass::ID retorna (integer),
            clienteTableClass::NOMBRE retorna  (string),
            clienteTableClass::APELLIDO retorna  (string),
            clienteTableClass::DOCUMENTO retorna  (integer),
            clienteTableClass::DIRECCION retorna  (string),
            clienteTableClass::TELEFONO retorna  (integer),
            clienteTableClass::ID_TIPO_ID retorna (integer),
            clienteTableClass::ID_CIUDAD retorna  (integer),
            clienteTableClass::UPDATE_AT retorna  (timestamp),
            ciudadTableClass::ID retorna  (integer),
            ciudadTableClass::NOMBRE_CIUDAD retorna  (string),
            tipoIdTableClass::ID retorna  (integer),
            tipoIdTableClass::DESCRIPCION retorna  (string), 
 * estos datos retornan en la variable $fields
*/
  public function execute() {
    try {
      $where = null;
      if (request::getInstance()->hasPost('report')) {
        $report = request::getInstance()->getPost('report');
        //Validar datos

        if (isset($report['nombre']) and $report['nombre'] !== null and $report['nombre'] !== '') {
          $where[] ='(' .  clienteTableClass::getNameField(clienteTableClass::NOMBRE) . ' LIKE ' . '\'' . $report['nombre'] . '%\'  '
              . 'OR ' . clienteTableClass::getNameField(clienteTableClass::NOMBRE) . ' LIKE ' . '\'%' . $report['nombre'] . '%\' '
              . 'OR ' . clienteTableClass::getNameField(clienteTableClass::NOMBRE) . ' LIKE ' . '\'%' . $report['nombre'].'\') ';       
              }//cierre del filtro nombre
              
        if (isset($report['apellido']) and $report['apellido'] !== null and $report['apellido'] !== '') {
         $where[] = '(' . clienteTableClass::getNameField(clienteTableClass::APELLIDO) . ' LIKE ' . '\'' . $report['apellido'] . '%\'  '
              . 'OR ' . clienteTableClass::getNameField(clienteTableClass::APELLIDO) . ' LIKE ' . '\'%' . $report['apellido'] . '%\' '
              . 'OR ' . clienteTableClass::getNameField(clienteTableClass::APELLIDO) . ' LIKE ' . '\'%' . $report['apellido'].'\') ';       
              }//cierre del filtro apellio    
                
        if (isset($report['documento']) and $report['documento'] !== null and $report['documento'] !== '') {
          $where[clienteTableClass::DOCUMENTO] = $report['documento'];
        }//cierre del filtro documento
        
        if (isset($report['ciudad']) and $report['ciudad'] !== null and $report['ciudad'] !== '') {
          $where[clienteTableClass::ID_CIUDAD] = $report['ciudad'];
        }//cierre del filtro ciudad
        
        if (isset($report['fecha1']) and $report['fecha1'] !== null and $report['fecha1'] !== '' and (isset($report['fecha2']) and $report['fecha2'] !== null and $report['fecha2'] !== '')) {
          $where[clienteTableClass::CREATED_AT] = array(
          date(config::getFormatTimestamp(), strtotime($report['fecha1'] . ' 00:00:00')),
          date(config::getFormatTimestamp(), strtotime($report['fecha2'] . ' 23:59:59'))
          );
        }//cierre del filtro fecha1 y fecha2
          
      }//cierre del POST filter
      $this->mensaje = 'Informacion de Clientes';
      $fields = array(
          clienteTableClass::ID,
          clienteTableClass::NOMBRE,
          clienteTableClass::APELLIDO,
          clienteTableClass::DOCUMENTO,
          clienteTableClass::DIRECCION,
          clienteTableClass::ID_TIPO_ID,
           clienteTableClass::ID_CIUDAD,
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
