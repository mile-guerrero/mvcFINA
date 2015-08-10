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
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class indexActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
        $where = null;
      if (request::getInstance()->hasPost('filter')) {
        $filter = request::getInstance()->getPost('filter');
        //Validar datos

        if (isset($filter['fechaMantenimiento']) and $filter['fechaMantenimiento'] !== null and $filter['fechaMantenimiento'] !== '') {
          $where[ordenServicioTableClass::FECHA_MANTENIMIENTO] = $filter['fechaMantenimiento'];
        }
        if (isset($filter['trabajador']) and $filter['trabajador'] !== null and $filter['trabajador'] !== '') {
          $where[ordenServicioTableClass::TRABAJADOR_ID] = $filter['trabajador'];
        }
        if (request::getInstance()->isMethod('POST')) {
//            echo 'dsasda';
//            exit();
            $fechaInicial = request::getInstance()->getPost(ordenServicioTableClass::getNameField(ordenServicioTableClass::CREATED_AT, true). '_1');
            
            $fechaFin = request::getInstance()->getPost(ordenServicioTableClass::getNameField(ordenServicioTableClass::CREATED_AT, true). '_2');
            
            if($fechaFin < $fechaInicial){
               session::getInstance()->setError('La fecha final no puede ser menor a la actual', 'inputFecha');
            }elseif($fechaFin == $fechaInicial){
                session::getInstance()->setError('La fecha final es igual a la inicial', 'inputFecha');
            }
            
        if ((isset($fechaInicial) and $fechaInicial !== null and $fechaInicial !== "") and ( isset($fechaFin) and $fechaFin !== null and $fechaFin !== "" )) {
          $where[ordenServicioTableClass::CREATED_AT] = array(
              date(config::getFormatTimestamp(), strtotime($fechaInicial . ' 00:00:00')),
              date(config::getFormatTimestamp(), strtotime($fechaFin . ' 23:59:59'))
          );
        }
            
          }
//      session::getInstance()->setAttribute('ordenServicioIndexFilters', $where);
//       }else if(session::getInstance()->hasAttribute('ordenServicioIndexFilters')){
//        $where = session::getInstance()->getAttribute('ordenServicioIndexFilters');
//    
        }
      $fields = array(
          ordenServicioTableClass::ID,
          ordenServicioTableClass::FECHA_MANTENIMIENTO,
          ordenServicioTableClass::TRABAJADOR_ID,
          ordenServicioTableClass::PRODUCTO_INSUMO_ID,
          ordenServicioTableClass::CANTIDAD,
          ordenServicioTableClass::VALOR,
          ordenServicioTableClass::MAQUINA_ID,
          ordenServicioTableClass::CREATED_AT,
          ordenServicioTableClass::UPDATED_AT
      );
      $orderBy = array(
         ordenServicioTableClass::ID
      );
       $page = 0;
      if (request::getInstance()->hasGet('page')) {
        $this->page = request::getInstance()->getGet('page');
        $page = request::getInstance()->getGet('page') - 1;
        $page = $page * config::getRowGrid();
      }
      $this->cntPages = ordenServicioTableClass::getTotalPages(config::getRowGrid(), $where);
      $this->objOS = ordenServicioTableClass::getAll($fields, false, $orderBy, 'ASC', config::getRowGrid(), $page, $where);
      $fields = array(
      trabajadorTableClass::ID,
      trabajadorTableClass::NOMBRET
      );
      $orderBy = array(
      trabajadorTableClass::NOMBRET   
      );      
      $this->objOST = trabajadorTableClass::getAll($fields, true, $orderBy, 'ASC');
       
      $this->defineView('index', 'ordenServicio', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      routing::getInstance()->redirect('ordenServicio', 'index');
//      echo $exc->getMessage();
//      echo '<br>';
//      echo $exc->getTraceAsString();
    }
}

}
