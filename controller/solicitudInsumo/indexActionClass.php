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
class indexActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      
      $where = null;
      if (request::getInstance()->hasPost('filter')) {
        $filter = request::getInstance()->getPost('filter');
        //Validar datos
        if(isset($filter['lote']) and $filter['lote'] !== null and $filter['lote'] !== ""){
        $where[solicitudInsumoTableClass::LOTE_ID] = $filter['lote'];
        }
        if (request::getInstance()->isMethod('POST')) {
//            echo 'dsasda';
//            exit();
            $fechaInicial = request::getInstance()->getPost(solicitudInsumoTableClass::getNameField(solicitudInsumoTableClass::CREATED_AT, true). '_1');
            
            $fechaFin = request::getInstance()->getPost(solicitudInsumoTableClass::getNameField(solicitudInsumoTableClass::CREATED_AT, true). '_2');
            
            if($fechaFin < $fechaInicial){
               session::getInstance()->setError('La fecha final no puede ser menor a la actual', 'inputFecha');
            }elseif($fechaFin == $fechaInicial){
                session::getInstance()->setError('La fecha final es igual a la inicial', 'inputFecha');
            }
            
        if ((isset($fechaInicial) and $fechaInicial !== null and $fechaInicial !== "") and ( isset($fechaFin) and $fechaFin !== null and $fechaFin !== "" )) {
          $where[solicitudInsumoTableClass::CREATED_AT] = array(
              date(config::getFormatTimestamp(), strtotime($fechaInicial . ' 00:00:00')),
              date(config::getFormatTimestamp(), strtotime($fechaFin . ' 23:59:59'))
          );
        }
            
          }
//      session::getInstance()->setAttribute('solicitudInsumoIndexFilters', $where);
//       }else if(session::getInstance()->hasAttribute('solicitudInsumoIndexFilters')){
//        $where = session::getInstance()->getAttribute('solicitudInsumoIndexFilters');
//     
        
       }
      
      $fields = array(
          solicitudInsumoTableClass::ID,
          solicitudInsumoTableClass::FECHA_HORA,
          solicitudInsumoTableClass::TRABAJADOR_ID,
          solicitudInsumoTableClass::CANTIDAD,
          solicitudInsumoTableClass::PRODUCTO_INSUMO_ID,
          solicitudInsumoTableClass::LOTE_ID,
          solicitudInsumoTableClass::CREATED_AT,
          solicitudInsumoTableClass::UPDATED_AT,
          solicitudInsumoTableClass::DELETED_AT
      );
      $orderBy = array(
         solicitudInsumoTableClass::ID
      );
      
      $page = 0;
      if (request::getInstance()->hasGet('page')) {
        $this->page = request::getInstance()->getGet('page');
        $page = request::getInstance()->getGet('page') - 1;
        $page = $page * config::getRowGrid();
      }
      $this->cntPages = solicitudInsumoTableClass::getTotalPages(config::getRowGrid(), $where);
      $this->objS = solicitudInsumoTableClass::getAll($fields, true, $orderBy, 'ASC', config::getRowGrid(), $page, $where);
      
       $fields = array(
      trabajadorTableClass::ID,
      trabajadorTableClass::NOMBRET
      );
      $orderBy = array(
      trabajadorTableClass::NOMBRET   
      );      
      $this->objT = trabajadorTableClass::getAll($fields, true, $orderBy, 'ASC');
      
      $fields = array(
          productoInsumoTableClass::ID,
          productoInsumoTableClass::DESCRIPCION
      );
      $orderBy = array(
          productoInsumoTableClass::DESCRIPCION
      );
      $this->objP = productoInsumoTableClass::getAll($fields, true, $orderBy, 'ASC');

      $fields = array(
          loteTableClass::ID,
          loteTableClass::UBICACION
      );
      $orderBy = array(
          loteTableClass::UBICACION
      );
      $this->objLote = loteTableClass::getAll($fields, true, $orderBy, 'ASC');
    
      $this->defineView('index', 'solicitudInsumo', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      routing::getInstance()->redirect('solicitudInsumo', 'index');
//      echo $exc->getMessage();
//      echo '<br>';
//      echo $exc->getTraceAsString();
    }
}

}
