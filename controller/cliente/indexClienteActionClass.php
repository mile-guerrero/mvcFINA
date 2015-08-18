<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use mvc\validator\clienteValidatorClass as validator;

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
        
        if ((isset($filter[clienteTableClass::getNameField(clienteTableClass::CREATED_AT, true) . '_1']) and empty($filter[clienteTableClass::getNameField(clienteTableClass::CREATED_AT, true) . '_1']) === false) and ( isset($filter[clienteTableClass::getNameField(clienteTableClass::CREATED_AT, true) . '_2']) and empty($filter[clienteTableClass::getNameField(clienteTableClass::CREATED_AT, true) . '_2']) === false)) {
          if (request::getInstance()->isMethod('POST')) {

            $fechaInicial = $filter[clienteTableClass::getNameField(clienteTableClass::CREATED_AT, true) . '_1'];
            $fechaFin = $filter[clienteTableClass::getNameField(clienteTableClass::CREATED_AT, true) . '_2'];

            validator::validateFiltroFecha($fechaInicial, $fechaFin);

            if ((isset($fechaInicial) and $fechaInicial !== null and $fechaInicial !== "") and ( isset($fechaFin) and $fechaFin !== null and $fechaFin !== "" )) {
              $where[] = '(' . clienteTableClass::getNameField(clienteTableClass::CREATED_AT) . ' BETWEEN ' . "'" . date(config::getFormatTimestamp(), strtotime($fechaInicial . ' 00:00:00')) . "'" . ' AND ' . "'" . date(config::getFormatTimestamp(), strtotime($fechaFin . ' 23:59:59')) . "'" . ' ) ';
            }
          }
        }
        
        if (isset($filter[clienteTableClass::getNameField(clienteTableClass::DOCUMENTO, true)]) and empty($filter[clienteTableClass::getNameField(clienteTableClass::DOCUMENTO, true)]) === false) {
          if (request::getInstance()->isMethod('POST')) {

            $documento = $filter[clienteTableClass::getNameField(clienteTableClass::DOCUMENTO, true)];
              validator::validateFiltro($documento);
            if (isset($documento) and $documento !== null and $documento !== '') {
              $where[] = '(' . clienteTableClass::getNameField(clienteTableClass::DOCUMENTO) . ' = ' .  $documento  . ' ) ';
            }
          }
        }
        
        if (isset($filter[clienteTableClass::getNameField(clienteTableClass::NOMBRE, true)]) and empty($filter[clienteTableClass::getNameField(clienteTableClass::NOMBRE, true)]) === false) {
          if (request::getInstance()->isMethod('POST')) {

            $nombre = $filter[clienteTableClass::getNameField(clienteTableClass::NOMBRE, true)];
             validator::validateFiltroNombre($nombre);
            if (isset($nombre) and $nombre !== null and $nombre !== '') {
          $where[] = '(' . clienteTableClass::getNameField(clienteTableClass::NOMBRE) . ' LIKE ' . '\'' . $nombre . '%\'  '
                  . 'OR ' . clienteTableClass::getNameField(clienteTableClass::NOMBRE) . ' LIKE ' . '\'%' . $nombre . '%\' '
                  . 'OR ' . clienteTableClass::getNameField(clienteTableClass::NOMBRE) . ' LIKE ' . '\'%' . $nombre . '\') ';
        }
          }
        }
        
        if (isset($filter[clienteTableClass::getNameField(clienteTableClass::APELLIDO, true)]) and empty($filter[clienteTableClass::getNameField(clienteTableClass::APELLIDO, true)]) === false) {
          if (request::getInstance()->isMethod('POST')) {

            $apellido = $filter[clienteTableClass::getNameField(clienteTableClass::APELLIDO, true)];
              validator::validateFiltroApellido($apellido);
            if (isset($apellido) and $apellido !== null and $apellido !== '') {
          $where[] = '(' . clienteTableClass::getNameField(clienteTableClass::APELLIDO) . ' LIKE ' . '\'' . $apellido . '%\'  '
                  . 'OR ' . clienteTableClass::getNameField(clienteTableClass::APELLIDO) . ' LIKE ' . '\'%' . $apellido . '%\' '
                  . 'OR ' . clienteTableClass::getNameField(clienteTableClass::APELLIDO) . ' LIKE ' . '\'%' . $apellido . '\') ';
        }
          }
        }

 if (isset($filter[clienteTableClass::getNameField(clienteTableClass::ID_CIUDAD, true)]) and empty($filter[clienteTableClass::getNameField(clienteTableClass::ID_CIUDAD, true)]) === false) {
          if (request::getInstance()->isMethod('POST')) {

            $ciudad = $filter[clienteTableClass::getNameField(clienteTableClass::ID_CIUDAD, true)];
             
             if (isset($ciudad) and $ciudad !== null and $ciudad !== '') {
          $where[clienteTableClass::ID_CIUDAD] = $ciudad;
        }//cierre del filtro ciudad
          }
        }
      

       
        
//       session::getInstance()->setAttribute('clienteIndexFilters', $where);
//       }else if(session::getInstance()->hasAttribute('clienteIndexFilters')){
//        $where = session::getInstance()->getAttribute('clienteIndexFilters');
//     
        
       }

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
      $this->cntPages = clienteTableClass::getTotalPages(config::getRowGrid(), $where);
      $this->objCliente = clienteTableClass::getAll($fields, true, $orderBy, 'ASC', config::getRowGrid(), $page, $where);
      

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
   routing::getInstance()->redirect('cliente', 'indexCliente');
      
//      echo $exc->getMessage();
//      echo '<br>';
//      echo $exc->getTraceAsString();
    }//cierre del catch
  }

//cierre de la funcion execute
}

//cierre de la clase
