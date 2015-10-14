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
        
               
        if (isset($report['lote']) and $report['lote'] !== null and $report['lote'] !== '') {
          $where[controlPlagaTableClass::LOTE_ID] = $report['lote'];
        }//cierre del filtro ciudad
        
        if (isset($report['fechaIni']) and $report['fechaIni'] !== null and $report['fechaIni'] !== '' and (isset($report['fechaFin']) and $report['fechaFin'] !== null and $report['fechaFin'] !== '')) {
          $where[controlPlagaTableClass::CREATED_AT] = array(
          date(config::getFormatTimestamp(), strtotime($report['fechaIni'] . ' 00:00:00')),
          date(config::getFormatTimestamp(), strtotime($report['fechaFin'] . ' 23:59:59'))
          );
        }//cierre del filtro fecha1 y fecha2
          
      }//cierre del POST filter
      $this->mensaje = 'Informacion del crontrol de la plaga';
      $fields = array(
          controlPlagaTableClass::ID,
          controlPlagaTableClass::LOTE_ID,
          controlPlagaTableClass::PLAGA_ID,
          controlPlagaTableClass::PRODUCTO_INSUMO_ID,
          controlPlagaTableClass::CANTIDAD,
          controlPlagaTableClass::UNIDAD_MEDIDA_ID
      );
      $orderBy = array(
          controlPlagaTableClass::LOTE_ID
      );
     
      $this->objControlPlaga = controlPlagaTableClass::getAll($fields, true, $orderBy, 'ASC', null, null,$where);
 
      $fields = array(
          loteTableClass::ID,
          loteTableClass::DESCRIPCION
      );
      $orderBy = array(
          loteTableClass::DESCRIPCION
      );
      $this->objLote = loteTableClass::getAll($fields, true, $orderBy, 'ASC'); 
 
      
      $this->defineView('index', 'controlPlaga', session::getInstance()->getFormatOutput());
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
