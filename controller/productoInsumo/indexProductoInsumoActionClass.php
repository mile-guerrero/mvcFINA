<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\validator\productoInsumoValidatorClass as validator;
use mvc\i18n\i18nClass as i18n;

/**
 * Description of ejemploClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class indexProductoInsumoActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {

      $where = null;
      if (request::getInstance()->hasPost('filter')) {
        $filter = request::getInstance()->getPost('filter');
        //validar

        if (request::getInstance()->hasPost(productoInsumoTableClass::getNameField(productoInsumoTableClass::DESCRIPCION, true)) and empty(mvc\request\requestClass::getInstance()->getPost(productoInsumoTableClass::getNameField(productoInsumoTableClass::DESCRIPCION, true))) === false) {

          if (request::getInstance()->isMethod('POST')) {
            $descripcion = request::getInstance()->getPost(productoInsumoTableClass::getNameField(productoInsumoTableClass::DESCRIPCION, true));



            validator::validateFiltro();

            if (isset($descripcion) and $descripcion !== null and $descripcion !== "") {
              $where[] = '(' . productoInsumoTableClass::getNameField(productoInsumoTableClass::DESCRIPCION) . ' LIKE ' . '\'' . $descripcion . '%\'  '
                      . 'OR ' . productoInsumoTableClass::getNameField(productoInsumoTableClass::DESCRIPCION) . ' LIKE ' . '\'%' . $descripcion . '%\' '
                      . 'OR ' . productoInsumoTableClass::getNameField(productoInsumoTableClass::DESCRIPCION) . ' LIKE ' . '\'%' . $descripcion . '\') ';
            }
          }
        }

         if ((request::getInstance()->hasPost(productoInsumoTableClass::getNameField(productoInsumoTableClass::CREATED_AT, true) . '_1') and empty(mvc\request\requestClass::getInstance()->getPost(productoInsumoTableClass::getNameField(productoInsumoTableClass::CREATED_AT, true) . '_1')) === false) and ( (request::getInstance()->hasPost(productoInsumoTableClass::getNameField(productoInsumoTableClass::CREATED_AT, true) . '_2') and empty(mvc\request\requestClass::getInstance()->getPost(productoInsumoTableClass::getNameField(productoInsumoTableClass::CREATED_AT, true) . '_2')) === false))) {

          if (request::getInstance()->isMethod('POST')) {
           
            $fechaInicial = request::getInstance()->getPost(productoInsumoTableClass::getNameField(productoInsumoTableClass::CREATED_AT, true) . '_1');
            $fechaFin = request::getInstance()->getPost(productoInsumoTableClass::getNameField(productoInsumoTableClass::CREATED_AT, true) . '_2');
     
            validator::validateFiltroFecha($fechaInicial,$fechaFin);
           
            if ((isset($fechaInicial) and $fechaInicial !== null and $fechaInicial !== "") and ( isset($fechaFin) and $fechaFin !== null and $fechaFin !== "" )) {
              $where[] = '(' . productoInsumoTableClass::getNameField(productoInsumoTableClass::CREATED_AT) . ' BETWEEN ' . "'" . date(config::getFormatTimestamp(), strtotime($fechaInicial . ' 00:00:00')) . "'" . ' AND ' . "'" .  date(config::getFormatTimestamp(), strtotime($fechaFin . ' 23:59:59')) . "'" . ' ) ';             
            }
          }
        }

        //fin validaciones



        
//      session::getInstance()->setAttribute('productoInsumoIndexFilters', $where);
//       }else if(session::getInstance()->hasAttribute('productoInsumoIndexFilters')){
//        $where = session::getInstance()->getAttribute('productoInsumoIndexFilters');
      }
      $fields = array(
          productoInsumoTableClass::ID,
          productoInsumoTableClass::DESCRIPCION,
          productoInsumoTableClass::NOMBRE_IMAGEN,
          productoInsumoTableClass::EXTENCION_IMAGEN,
          productoInsumoTableClass::HASH_IMAGEN,
          productoInsumoTableClass::TIPO_PRODUCTO_INSUMO_ID,
          productoInsumoTableClass::INFORMACION,
          productoInsumoTableClass::CREATED_AT
      );
      $orderBy = array(
          productoInsumoTableClass::DESCRIPCION
      );
      $page = 0;
      if (request::getInstance()->hasGet('page')) {
        $this->page = request::getInstance()->getGet('page');
        $page = request::getInstance()->getGet('page') - 1;
        $page = $page * config::getRowGrid();
      }
      $this->cntPages = productoInsumoTableClass::getTotalPages(config::getRowGrid(), $where);

      $this->objPI = productoInsumoTableClass::getAll($fields, true, $orderBy, 'ASC', config::getRowGrid(), $page, $where);

//      $fields = array(
//          unidadMedidaTableClass::ID,
//          unidadMedidaTableClass::DESCRIPCION
//      );
//      $orderBy = array(
//          unidadMedidaTableClass::DESCRIPCION
//      );
//      $this->objPIUM = unidadMedidaTableClass::getAll($fields, false, $orderBy, 'ASC');

      $fields = array(
          tipoProductoInsumoTableClass::ID,
          tipoProductoInsumoTableClass::DESCRIPCION
      );
      $orderBy = array(
          tipoProductoInsumoTableClass::DESCRIPCION
      );
      $this->objPITPI = tipoProductoInsumoTableClass::getAll($fields, true, $orderBy, 'ASC');

      $this->defineView('indexProductoInsumo', 'productoInsumo', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      routing::getInstance()->redirect('productoInsumo', 'indexProductoInsumo');
//      echo $exc->getMessage();
//      echo '<br>';
//      echo $exc->getTraceAsString();
    }
  }

}

//            if($fechaFin < $fechaInicial){
//               session::getInstance()->setError('La fecha final no puede ser menor a la actual', 'inputFecha');
//               session::getInstance()->setFlash('modalFilters', true);
//             }elseif($fechaFin == $fechaInicial){
//                session::getInstance()->setError('La fecha final es igual a la inicial', 'inputFecha');
//                session::getInstance()->setFlash('modalFilters', true);
//            }