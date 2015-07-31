<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use mvc\validator\manoObraValidatorClass as validator;

/**
 * Description of ejemploClass
 * @date: 2015/06/01.
 * @category: Modulo mano de obra.
 *
 * @author Gonzalo Andres Bejarano, Elcy Milena Guerrero, Andres Eduardo Bahamon
 */
class reportActionClass extends controllerClass implements controllerActionInterface {
    
   /**
   * Método para leer el registro que se desea consultar
   *
   * @param array $fields Array con los nombres de los campos a solicitar
   * @param array $orderBy [optional] Array con el o los nombres de los campos
   * por los cuales se ordenará la consulta
   * @param string $order [optional] Forma de ordenar la consulta
   * (por defecto NULL), pude ser ASC o DESC
   * @param $page Forma de ver cuantas paginas se encuentran.
   * @param $where Forma de consultar informes
   * de datos a mostrar.
   * @return datatype description: \PDOException|boolean.
   * 
   */

  public function execute() {
    try {
        
         $where = null;
      
      if (request::getInstance()->hasPost('report')) {
        $report = request::getInstance()->getPost('report');
        //Validar datos
        
//        if (!is_numeric(isset($report['cantidad']) and $report['cantidad'] !== null and $report['cantidad'] !== '')) {
//            $where[manoObraTableClass::CANTIDAD_HORA] = $report['cantidad'];
//            session::getInstance()->setError(i18n::__(00010, null, 'errors', array(':numeros' => manoObraTableClass::CANTIDAD_HORA)), 00010);
//            $flag = true;
//          if (!is_numeric('cantidad')) {
//            session::getInstance()->setError(i18n::__(00010, null, 'errors', array(':numeros' => 'cantidad')), 00010);
//       }
       
//        if (isset($report['trabajador']) and $report['trabajador'] !== null and $report['trabajador'] !== '') {
//          $where[manoObraTableClass::TRABAJADOR_ID] = $report['trabajador'];
//        }
//        if (isset($report['cooperativa']) and $report['cooperativa'] !== null and $report['cooperativa'] !== '') {
//          $where[manoObraTableClass::COOPERATIVA_ID] = $report['cooperativa'];
//        }
  
        if (isset($report['fechaIni']) and $report['fechaIni'] !== null and $report['fechaIni'] !== '' and ( isset($report['fechaFin']) and $report['fechaFin'] !== null and $report['fechaFin'] !== '')) {
          $where[detalleFacturaCompraTableClass::CREATED_AT] = array(
              date(config::getFormatTimestamp(), strtotime($report['fechaIni'] . ' 00:00:00')),
              date(config::getFormatTimestamp(), strtotime($report['fechaFin'] . ' 23:59:59'))
          );
        }
      }
        
          $idFactura = request::getInstance()->getRequest(facturaCompraTableClass::ID, true);
          $fieldsFactura = array(
          facturaCompraTableClass::ID,
          facturaCompraTableClass::FECHA
          
      );

      $whereFactura = array(
          facturaCompraTableClass::ID => request::getInstance()->getRequest(facturaCompraTableClass::ID)
              
        );
      
       $this->objFactura = facturaCompraTableClass::getAll($fieldsFactura, false, null, null, null, null, $whereFactura);
      
      $idDetalle = request::getInstance()->getRequest(detalleFacturaCompraTableClass::ID, true);
      $this->mensaje = 'Informacion de Factura Compra';
      $fields = array(
          detalleFacturaCompraTableClass::ID,
          detalleFacturaCompraTableClass::DESCRIPCION,
          detalleFacturaCompraTableClass::CANTIDAD,
          detalleFacturaCompraTableClass::VALOR_UNIDAD,
          detalleFacturaCompraTableClass::VALOR_TOTAL,
          detalleFacturaCompraTableClass::PROVEEDOR_ID,
          detalleFacturaCompraTableClass::FACTURA_COMPRA_ID,
          detalleFacturaCompraTableClass::CREATED_AT,
          detalleFacturaCompraTableClass::UPDATED_AT
      );

      $where = array(
          detalleFacturaCompraTableClass::FACTURA_COMPRA_ID =>$idDetalle 
      );
      $this->objDetalleFactura = detalleFacturaCompraTableClass::getAll($fields, false, null, null, null, null, $where);
      
      
      
     
      
      $this->defineView('index', 'detalleFacturaCompra', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }
  }

}

//public function validate($cantidad) {
//
//    $flag = false;
////---------------------validacion descripcion----------------------------------- 
//    
//     if (!is_numeric($cantidad)) {
//     session::getInstance()->setError(i18n::__(00010, null, 'errors', array(':numeros' => $cantidad)), 00010);
//    }   
//    
//
////    if (strlen($descripcion) == "" or $iva === null) {
////      session::getInstance()->setError(i18n::__(00009, null, 'errors', array(':campo vacio' => productoInsumoTableClass::DESCRIPCION)), 00009);
////      $flag = true;
////    }
////-----------------------validacion iva-----------------------------------------    
////-----------------------validacion --------------------------------------------    
//    if ($flag === true){
//      request::getInstance()->setMethod('GET');
//      routing::getInstance()->forward('manoObra', 'index');
//    }
//  }

//}