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
        if (request::getInstance()->hasPost(loteTableClass::getNameField(loteTableClass::UBICACION, true)) and empty(mvc\request\requestClass::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::UBICACION, true))) === false) {

          if (request::getInstance()->isMethod('POST')) {
            $ubicacion = request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::UBICACION, true));
            validator::validateFiltro();

            if (isset($ubicacion) and $ubicacion !== null and $ubicacion !== "") {
              $where[] = '(' . loteTableClass::getNameField(loteTableClass::UBICACION) . ' LIKE ' . '\'' . $ubicacion . '%\'  '
                      . 'OR ' . loteTableClass::getNameField(loteTableClass::UBICACION) . ' LIKE ' . '\'%' . $ubicacion . '%\' '
                      . 'OR ' . loteTableClass::getNameField(loteTableClass::UBICACION) . ' LIKE ' . '\'%' . $ubicacion . '\') ';
            }//cierre del filtro ubicacion   
          }
        }
        //-----------------fin validacion--------



        if ((isset($filter['tamanoIni']) and $filter['tamanoIni'] !== null and $filter['tamanoIni'] !== "") and ( isset($filter['tamanoFin']) and $filter['tamanoFin'] !== null and $filter['tamanoFin'] !== "" )) {
          $where[loteTableClass::TAMANO] = array(
              $filter['tamanoIni'],
              $filter['tamanoFin']
          );
        }//cierre del filtro tamanoIni y tamanoFin       

        if ((isset($filter['fechaIni']) and $filter['fechaIni'] !== null and $filter['fechaIni'] !== "") and ( isset($filter['fechaFin']) and $filter['fechaFin'] !== null and $filter['fechaFin'] !== "" )) {
          $where[loteTableClass::CREATED_AT] = array(
              date(config::getFormatTimestamp(), strtotime($filter['fechaIni'] . ' 00:00:00')),
              date(config::getFormatTimestamp(), strtotime($filter['fechaFin'] . ' 23:59:59'))
          );
        } //cierre del filtro fechaIni y fechaFin

        if ((isset($filter['fechaSI']) and $filter['fechaSI'] !== null and $filter['fechaSI'] !== "") and ( isset($filter['fechaSF']) and $filter['fechaSF'] !== null and $filter['fechaSF'] !== "" )) {
          $where[loteTableClass::FECHA_INICIO_SIEMBRA] = array(
              date(config::getFormatTimestamp(), strtotime($filter['fechaSI'] . ' 00:00:00')),
              date(config::getFormatTimestamp(), strtotime($filter['fechaSF'] . ' 23:59:59'))
          );
        } //cierre del filtro fechaSI y fechaSF


        if (isset($filter['ciudad']) and $filter['ciudad'] !== null and $filter['ciudad'] !== "") {
          $where[loteTableClass::ID_CIUDAD] = $filter['ciudad'];
        }//cierre del filtro ciudad
//      session::getInstance()->setAttribute('loteIndexFilters', $where);
//       }else if(session::getInstance()->hasAttribute('loteIndexFilters')){
//        $where = session::getInstance()->getAttribute('loteIndexFilters');
//   
        }

      $fields = array(
          loteTableClass::ID,
          loteTableClass::UBICACION,
              /* loteTableClass::TAMANO,
                loteTableClass::UNIDAD_DISTANCIA_ID,
                loteTableClass::DESCRIPCION,
                loteTableClass::FECHA_INICIO_SIEMBRA,
                loteTableClass::NUMERO_PLANTULAS,
                loteTableClass::PRESUPUESTO,
                loteTableClass::PRODUCTO_INSUMO_ID,
                loteTableClass::ID_CIUDAD,
                loteTableClass::CREATED_AT,
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