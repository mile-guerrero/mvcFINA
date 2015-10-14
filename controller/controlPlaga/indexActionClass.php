<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use mvc\validator\controlPlagaValidatorClass as validator;

/**
 * @author Gonzalo Andres Bejarano, Elcy Milena Guerrero, Andres Eduardo Bahamon 
 * @date: fecha de inicio del desarrollo.
 * @category: modulo de cliente.
 */
class indexActionClass extends controllerClass implements controllerActionInterface {

  /**
   * @author: Gonzalo Andres Bejarano, Elcy Milena Guerrero, Andres Eduardo Bahamon .
   * @date: fecha de inicio del desarrollo.
   * @return   controlPlagaTableClass::ID retorna (integer),
    controlPlagaTableClass::NOMBRE retorna  (string),
    controlPlagaTableClass::APELLIDO retorna  (string),
    controlPlagaTableClass::DOCUMENTO retorna  (integer),
    controlPlagaTableClass::DIRECCION retorna  (string),
    controlPlagaTableClass::TELEFONO retorna  (integer),
    controlPlagaTableClass::ID_TIPO_ID retorna (integer),
    controlPlagaTableClass::ID_CIUDAD retorna  (integer),
    controlPlagaTableClass::UPDATE_AT retorna  (timestamp),
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
        
        if ((isset($filter[controlPlagaTableClass::getNameField(controlPlagaTableClass::CREATED_AT, true) . '_1']) and empty($filter[controlPlagaTableClass::getNameField(controlPlagaTableClass::CREATED_AT, true) . '_1']) === false) and ( isset($filter[controlPlagaTableClass::getNameField(controlPlagaTableClass::CREATED_AT, true) . '_2']) and empty($filter[controlPlagaTableClass::getNameField(controlPlagaTableClass::CREATED_AT, true) . '_2']) === false)) {
          if (request::getInstance()->isMethod('POST')) {

            $fechaInicial = $filter[controlPlagaTableClass::getNameField(controlPlagaTableClass::CREATED_AT, true) . '_1'];
            $fechaFin = $filter[controlPlagaTableClass::getNameField(controlPlagaTableClass::CREATED_AT, true) . '_2'];

            validator::validateFiltroFecha($fechaInicial, $fechaFin);

            if ((isset($fechaInicial) and $fechaInicial !== null and $fechaInicial !== "") and ( isset($fechaFin) and $fechaFin !== null and $fechaFin !== "" )) {
              $where[] = '(' . controlPlagaTableClass::getNameField(controlPlagaTableClass::CREATED_AT) . ' BETWEEN ' . "'" . date(config::getFormatTimestamp(), strtotime($fechaInicial . ' 00:00:00')) . "'" . ' AND ' . "'" . date(config::getFormatTimestamp(), strtotime($fechaFin . ' 23:59:59')) . "'" . ' ) ';
            }
          }
        }


 if (isset($filter[controlPlagaTableClass::getNameField(controlPlagaTableClass::LOTE_ID, true)]) and empty($filter[controlPlagaTableClass::getNameField(controlPlagaTableClass::LOTE_ID, true)]) === false) {
          if (request::getInstance()->isMethod('POST')) {

            $lote = $filter[controlPlagaTableClass::getNameField(controlPlagaTableClass::LOTE_ID, true)];
             
             if (isset($lote) and $lote !== null and $lote !== '') {
          $where[controlPlagaTableClass::LOTE_ID] = $lote;
        }//cierre del filtro ciudad
          }
        }
      

       
        
//       session::getInstance()->setAttribute('clienteIndexFilters', $where);
//       }else if(session::getInstance()->hasAttribute('clienteIndexFilters')){
//        $where = session::getInstance()->getAttribute('clienteIndexFilters');
//     
        
   }

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
      $page = 0;
      if (request::getInstance()->hasGet('page')) {
        $this->page = request::getInstance()->getGet('page');
        $page = request::getInstance()->getGet('page') - 1;
        $page = $page * config::getRowGrid();
      }//cierre del if del paguinado
      $this->cntPages = controlPlagaTableClass::getTotalPages(config::getRowGrid(), $where);
      $this->objControlPlaga = controlPlagaTableClass::getAll($fields, true, $orderBy, 'ASC', config::getRowGrid(), $page, $where);
      
      $fields = array(
          loteTableClass::ID,
          loteTableClass::UBICACION
      );
      $orderBy = array(
          loteTableClass::UBICACION
      );
      $this->objLote = loteTableClass::getAll($fields, true, $orderBy, 'ASC'); 
      
      
      $this->defineView('index', 'controlPlaga', session::getInstance()->getFormatOutput());
    } //cierre del try
    catch (PDOException $exc) {
   routing::getInstance()->redirect('controlPlaga', 'index');
      
//      echo $exc->getMessage();
//      echo '<br>';
//      echo $exc->getTraceAsString();
    }//cierre del catch
  }

//cierre de la funcion execute
}

//cierre de la clase
