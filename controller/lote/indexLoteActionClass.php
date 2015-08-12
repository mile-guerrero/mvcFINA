<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use mvc\validator\loteValidatorClass as validator;

/**
 * @author Gonzalo Andres Bejarano, Elcy Milena Guerrero, Andres Eduardo Bahamon 
 * @date: fecha de inicio del desarrollo.
 * @category: modulo de maquina.
 */
class indexLoteActionClass extends controllerClass implements controllerActionInterface {

  /**
   * @author: Gonzalo Andres Bejarano, Elcy Milena Guerrero, Andres Eduardo Bahamon .
   * @date: fecha de inicio del desarrollo.
   * @return   loteTableClass::ID (integer),
    loteTableClass::UBICACION (string),
    unidadDistanciaTableClass::ID (integer),
    unidadDistanciaTableClass::DESCRIPCION (string),
    ciudadTableClass::ID (integer),
    ciudadTableClass::NOMBRE_CIUDAD (string),
    loteTableClass::ID  (integer),
    loteTableClass::DESCRIPCION  (string)


   * estos datos retornan en la variable $fields
   */
  public function execute() {
    try {

      $where = null;
      if (request::getInstance()->hasPost('filter')) {
        $filter = request::getInstance()->getPost('filter');
        //validar
//        if ((request::getInstance()->hasPost(loteTableClass::getNameField(loteTableClass::CREATED_AT, true) . '_1') and empty(mvc\request\requestClass::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::CREATED_AT, true) . '_1')) === false) and ( (request::getInstance()->hasPost(loteTableClass::getNameField(loteTableClass::CREATED_AT, true) . '_2') and empty(mvc\request\requestClass::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::CREATED_AT, true) . '_2')) === false))) {
//
//          if (request::getInstance()->isMethod('POST')) {
//           
//            $fechaInicial = request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::CREATED_AT, true) . '_1');
//            $fechaFin = request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::CREATED_AT, true) . '_2');
//     
//            validator::validateFiltroFecha($fechaInicial,$fechaFin);
//           
//            if ((isset($fechaInicial) and $fechaInicial !== null and $fechaInicial !== "") and ( isset($fechaFin) and $fechaFin !== null and $fechaFin !== "" )) {
//              $where[] = '(' . loteTableClass::getNameField(loteTableClass::CREATED_AT) . ' BETWEEN ' . "'" . date(config::getFormatTimestamp(), strtotime($fechaInicial . ' 00:00:00')) . "'" . ' AND ' . "'" .  date(config::getFormatTimestamp(), strtotime($fechaFin . ' 23:59:59')) . "'" . ' ) ';             
//            }
//          }
//        }

        if (request::getInstance()->hasPost(loteTableClass::getNameField(loteTableClass::UBICACION, true)) and empty(mvc\request\requestClass::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::UBICACION, true))) === false) {

          if (request::getInstance()->isMethod('POST')) {
            $ubicacion = request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::UBICACION, true));
            validator::validateFiltro();

            if (isset($ubicacion) and $ubicacion !== null and $ubicacion !== "") {
              $where[] = '(' . loteTableClass::getNameField(loteTableClass::UBICACION) . ' LIKE ' . '\'' . $ubicacion . '%\'  '
                      . 'OR ' . loteTableClass::getNameField(loteTableClass::UBICACION) . ' LIKE ' . '\'%' . $ubicacion . '%\' '
                      . 'OR ' . loteTableClass::getNameField(loteTableClass::UBICACION) . ' LIKE ' . '\'%' . $ubicacion . '\') ';
            
              
            }
          }
        }


//        if ((isset($filter['tamanoIni']) and $filter['tamanoIni'] !== null and $filter['tamanoIni'] !== "") and ( isset($filter['tamanoFin']) and $filter['tamanoFin'] !== null and $filter['tamanoFin'] !== "" )) {
//          $where[] = '(' . loteTableClass::getNameField(loteTableClass::TAMANO) . ' BETWEEN ' . "'" . $filter['tamanoIni'] . "'" . ' AND ' . "'" .   $filter['tamanoFin'] . "'" . ' ) ';             
//            
//        }//cierre del filtro tamanoIni y tamanoFin       
//      session::getInstance()->setAttribute('loteIndexFilters', $where);
//       }else if(session::getInstance()->hasAttribute('loteIndexFilters')){
//        $where = session::getInstance()->getAttribute('loteIndexFilters');
//   
      }

      $fields = array(
          loteTableClass::ID,
          loteTableClass::UBICACION,
          loteTableClass::CREATED_AT,
          loteTableClass::TAMANO
              /* 
                loteTableClass::UNIDAD_DISTANCIA_ID,
                loteTableClass::DESCRIPCION,
                loteTableClass::FECHA_INICIO_SIEMBRA,
                loteTableClass::NUMERO_PLANTULAS,
                loteTableClass::PRESUPUESTO,
                loteTableClass::PRODUCTO_INSUMO_ID,
                loteTableClass::ID_CIUDAD,
                
                loteTableClass::UPDATED_AT */
      );
      $orderBy = array(
          loteTableClass::ID
      );
      $page = 0;
      if (request::getInstance()->hasGet('page')) {
        $this->page = request::getInstance()->getGet('page');
        $page = request::getInstance()->getGet('page') - 1;
        $page = $page * config::getRowGrid();
      }
      $this->cntPages = loteTableClass::getTotalPages(config::getRowGrid(), $where);

      $this->objLote = loteTableClass::getAll($fields, true, $orderBy, 'ASC', config::getRowGrid(), $page, $where);

      $fields = array(
          unidadDistanciaTableClass::ID,
          unidadDistanciaTableClass::DESCRIPCION
      );
      $orderBy = array(
          unidadDistanciaTableClass::DESCRIPCION
      );
      $this->objLUD = unidadDistanciaTableClass::getAll($fields, false, $orderBy, 'ASC');



      $fields = array(
          ciudadTableClass::ID,
          ciudadTableClass::NOMBRE_CIUDAD
      );
      $orderBy = array(
          ciudadTableClass::NOMBRE_CIUDAD
      );
      $this->objLC = ciudadTableClass::getAll($fields, false, $orderBy, 'ASC');


      $fields = array(
          loteTableClass::ID,
          loteTableClass::DESCRIPCION
      );
      $orderBy = array(
          loteTableClass::DESCRIPCION
      );
      $this->objLPI = loteTableClass::getAll($fields, true, $orderBy, 'ASC');

      $this->defineView('indexLote', 'lote', session::getInstance()->getFormatOutput());
    }//cierre del try
    catch (PDOException $exc) {
      routing::getInstance()->redirect('lote', 'indexLote');
//      echo $exc->getMessage();
//      echo '<br>';
//      echo $exc->getTraceAsString();
    }//cierre del catch
  }

//cierre de la funcion execute
}

//cierre de la clase