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
class indexClienteActionClass extends controllerClass implements controllerActionInterface {

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
 * estos datos retornan en la variable $fields
*/
  public function execute() {
    try {
    $where = null;
      if (request::getInstance()->hasPost('filter')) {
        $filter = request::getInstance()->getPost('filter');
        //Validar datos

        if (isset($filter['nombre']) and $filter['nombre'] !== null and $filter['nombre'] !== '') {
          $where[] ='(' .  clienteTableClass::getNameField(clienteTableClass::NOMBRE) . ' LIKE ' . '\'' . $filter['nombre'] . '%\'  '
              . 'OR ' . clienteTableClass::getNameField(clienteTableClass::NOMBRE) . ' LIKE ' . '\'%' . $filter['nombre'] . '%\' '
              . 'OR ' . clienteTableClass::getNameField(clienteTableClass::NOMBRE) . ' LIKE ' . '\'%' . $filter['nombre'].'\') ';       
              }//cierre del filtro nombre
              
        if (isset($filter['apellido']) and $filter['apellido'] !== null and $filter['apellido'] !== '') {
         $where[] = '(' . clienteTableClass::getNameField(clienteTableClass::APELLIDO) . ' LIKE ' . '\'' . $filter['apellido'] . '%\'  '
              . 'OR ' . clienteTableClass::getNameField(clienteTableClass::APELLIDO) . ' LIKE ' . '\'%' . $filter['apellido'] . '%\' '
              . 'OR ' . clienteTableClass::getNameField(clienteTableClass::APELLIDO) . ' LIKE ' . '\'%' . $filter['apellido'].'\') ';       
              }//cierre del filtro apellio
        
        if (isset($filter['documento']) and $filter['documento'] !== null and $filter['documento'] !== '') {
          $where[clienteTableClass::DOCUMENTO] = $filter['documento'];
        }//cierre del filtro documento
        
        if (isset($filter['ciudad']) and $filter['ciudad'] !== null and $filter['ciudad'] !== '') {
          $where[clienteTableClass::ID_CIUDAD] = $filter['ciudad'];
        }//cierre del filtro ciudad
        
        if (isset($filter['fecha1']) and $filter['fecha1'] !== null and $filter['fecha1'] !== '' and (isset($filter['fecha2']) and $filter['fecha2'] !== null and $filter['fecha2'] !== '')) {
          $where[clienteTableClass::CREATED_AT] = array(
          date(config::getFormatTimestamp(), strtotime($filter['fecha1'] . ' 00:00:00')),
          date(config::getFormatTimestamp(), strtotime($filter['fecha2'] . ' 23:59:59'))
          );
        }//cierre del filtro fecha1 y fecha2
      }//cierre del POST filter
        
      $fields = array(
          clienteTableClass::ID,
          clienteTableClass::NOMBRE,
          clienteTableClass::APELLIDO,
          clienteTableClass::DOCUMENTO,
          clienteTableClass::DIRECCION,
          clienteTableClass::TELEFONO,
          clienteTableClass::ID_TIPO_ID,
          clienteTableClass::ID_CIUDAD,
          clienteTableClass::CREATED_AT,
          clienteTableClass::UPDATED_AT
      );
      $orderBy = array(
         clienteTableClass::NOMBRE
      );
       $page = 0;
      if (request::getInstance()->hasGet('page')) {
        $this->page = request::getInstance()->getGet('page');
        $page = request::getInstance()->getGet('page') - 1;
        $page = $page * config::getRowGrid();
      }//cierre del if del paguinado
      $this->cntPages = clienteTableClass::getTotalPages(config::getRowGrid());
      $this->objCliente = clienteTableClass::getAll($fields, true, $orderBy, 'ASC', config::getRowGrid(), $page,$where);
      $fields = array(     
      ciudadTableClass::ID, 
      ciudadTableClass::NOMBRE_CIUDAD
      );
      $orderBy = array(
      ciudadTableClass::NOMBRE_CIUDAD    
      ); 
      $this->objCC = ciudadTableClass::getAll($fields, false, $orderBy, 'ASC');
    
      $this->defineView('indexCliente', 'cliente', session::getInstance()->getFormatOutput());
    } //cierre del try
     catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }//cierre del catch
}//cierre de la funcion execute

}//cierre de la clase
