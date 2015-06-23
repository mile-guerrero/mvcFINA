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
        if (isset($report['cooperativa']) and $report['cooperativa'] !== null and $report['cooperativa'] !== '') {
          $where[manoObraTableClass::COOPERATIVA_ID] = $report['cooperativa'];
        }
  
        if (isset($report['fecha1']) and $report['fecha1'] !== null and $report['fecha1'] !== '' and (isset($report['fecha2']) and $report['fecha2'] !== null and $report['fecha2'] !== '')) {
          $where[manoObraTableClass::CREATED_AT] = array(
          date(config::getFormatTimestamp(), strtotime($report['fecha1'] . ' 00:00:00')),
          date(config::getFormatTimestamp(), strtotime($report['fecha2'] . ' 23:59:59'))
          );
        }
      }
//      $cantidad = 'cantidad';
//      $this->validate($cantidad);
//      validator::validateInsert();
      $this->mensaje = 'Informacion de la Mano de Obra';
      $fields = array(
          manoObraTableClass::ID,
          manoObraTableClass::CANTIDAD_HORA,
          manoObraTableClass::VALOR_HORA,
          manoObraTableClass::COOPERATIVA_ID,
          manoObraTableClass::LABOR_ID,
          manoObraTableClass::MAQUINA_ID,
          manoObraTableClass::CREATED_AT,
          manoObraTableClass::UPDATED_AT,
          manoObraTableClass::DELETED_AT
      );
      $orderBy = array(
         manoObraTableClass::ID
      );
      $this->objManoObra = manoObraTableClass::getAll($fields, true, $orderBy, 'ASC', null, null, $where);
 
      $fields = array(
           cooperativaTableClass::ID,
           cooperativaTableClass::NOMBRE
      );
      $orderBy = array(
           cooperativaTableClass::NOMBRE   
      );      
      $this->objCooperativa = cooperativaTableClass::getAll($fields, true, $orderBy, 'ASC');
 
      $this->defineView('index', 'manoObra', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      routing::getInstance()->redirect('manoObra', 'index');
      session::getInstance()->setFlash('exc', $exc);
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

}