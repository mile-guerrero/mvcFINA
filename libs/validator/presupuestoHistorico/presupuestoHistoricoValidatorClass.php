<?php
namespace mvc\validator {
  
  use mvc\validator\validatorClass;
  use mvc\session\sessionClass as session;
  use mvc\request\requestClass as request;
  use mvc\routing\routingClass as routing;
  use mvc\config\myConfigClass as config;
  /**
   * Description of presupuestoHistoricoValidatorClass
   *
   * @author Gonzalo Andres Bejarano, Elcy Milena Guerrero, Andres Eduardo Bahamon
   */
  class presupuestoHistoricoValidatorClass extends validatorClass {
    public static function validateInsert() {
      $flag = false;
      
      if (self::notBlank(request::getInstance()->getPost(\presupuestoHistoricoTableClass::getNameField(\presupuestoHistoricoTableClass::PRESUPUESTO, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputPresupuesto', true);
        session::getInstance()->setError('El presupuesto es requerida', 'inputPresupuesto');
      } else if (!is_numeric(request::getInstance()->getPost(\presupuestoHistoricoTableClass::getNameField(\presupuestoHistoricoTableClass::PRESUPUESTO, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputPresupuesto', true);
        session::getInstance()->setError('El presupuesto no puede ser letras', 'inputPresupuesto');
      
       //-------------------------------campo presupuesto-----------------------------
      }
       if (self::notBlank(request::getInstance()->getPost(\presupuestoHistoricoTableClass::getNameField(\presupuestoHistoricoTableClass::TOTAL_PRODUCCION, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputTotalProduccion', true);
        session::getInstance()->setError('La produccion es requerida', 'inputTotalProduccion');
      } else if (!is_numeric(request::getInstance()->getPost(\presupuestoHistoricoTableClass::getNameField(\presupuestoHistoricoTableClass::TOTAL_PRODUCCION, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputTotalProduccion', true);
        session::getInstance()->setError('La produccion no puede ser letras', 'inputTotalProduccion');
      } else if(strlen(request::getInstance()->getPost(\presupuestoHistoricoTableClass::getNameField(\presupuestoHistoricoTableClass::TOTAL_PRODUCCION, true))) > \presupuestoHistoricoTableClass::TOTAL_PRODUCCION_LENGTH) {
        $flag = true;
        session::getInstance()->setFlash('inputTotalProduccion', true);
        session::getInstance()->setError('La produccion digitada sobre pasa los caracteres permitidos', 'inputTotalProduccion');
        
       //-------------------------------campo presupuesto----------------------------- 
      }if (self::notBlank(request::getInstance()->getPost(\presupuestoHistoricoTableClass::getNameField(\presupuestoHistoricoTableClass::TOTAL_PAGO_TRABAJADOR, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputTotalPago', true);
        session::getInstance()->setError('El total pago es requerida', 'inputTotalPago');
      } else if (!is_numeric(request::getInstance()->getPost(\presupuestoHistoricoTableClass::getNameField(\presupuestoHistoricoTableClass::TOTAL_PAGO_TRABAJADOR, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputTotalPago', true);
        session::getInstance()->setError('El total pago no puede ser letras', 'inputTotalPago');
      } else if(strlen(request::getInstance()->getPost(\presupuestoHistoricoTableClass::getNameField(\presupuestoHistoricoTableClass::TOTAL_PAGO_TRABAJADOR, true))) > \presupuestoHistoricoTableClass::TOTAL_PAGO_TRABAJADOR_LENGTH) {
        $flag = true;
        session::getInstance()->setFlash('inputTotalPago', true);
        session::getInstance()->setError('El total pago digitado sobre pasa los caracteres permitidos', 'inputTotalPago');
        
          //----campo nulo----
      } if (self::notBlank(request::getInstance()->getPost(\presupuestoHistoricoTableClass::getNameField(\presupuestoHistoricoTableClass::LOTE_ID, true)))) {
        $flag = true;
        session::getInstance()->setFlash('selectLote', true);
        session::getInstance()->setError('El lote es requerido', 'selectLote');
        //-------------------------------campo Labor-----------------------------
          //----campo nulo----
      } if (self::notBlank(request::getInstance()->getPost(\presupuestoHistoricoTableClass::getNameField(\presupuestoHistoricoTableClass::PRODUCTO_INSUMO_ID, true)))) {
        $flag = true;
        session::getInstance()->setFlash('selectProducto', true);
        session::getInstance()->setError('El producto es requerido', 'selectProducto');
//      }
//        if (self::notBlank(request::getInstance()->getPost(\solicitudInsumoTableClass::getNameField(\solicitudInsumoTableClass::VALOR_HORA, true)))) {
//        $flag = true;
//        session::getInstance()->setFlash('inputValor', true);
//        session::getInstance()->setError('El valor es requerida', 'inputValor');
//      } else if (!is_numeric(request::getInstance()->getPost(\solicitudInsumoTableClass::getNameField(\manoObraTableClass::VALOR_HORA, true)))) {
//        $flag = true;
//        session::getInstance()->setFlash('inputValor', true);
//        session::getInstance()->setError('El valor no puede ser letras', 'inputValor');
//      } else if(strlen(request::getInstance()->getPost('inputCantidad')) > \manoObraTableClass::CANTIDAD_HORA_LENGTH) {
//        $flag = true;
//        session::getInstance()->setFlash('inputCantidad', true);
//        session::getInstance()->setError('El usuario digitado es mayor en cantidad de caracteres a lo permitido', 'inputCantidad');
//      } else if(self::isUnique(\usuarioTableClass::ID, true, array(\manoObraTableClass::CANTIDAD_HORA_LENGTH => request::getInstance()->getPost('inputCantidad')), \usuarioTableClass::getNameTable())) {
//        $flag = true;
//        session::getInstance()->setFlash('inputCantidad', true);
//        session::getInstance()->setError('El usuario digitado ya existe', 'inputCantidad');
//      }
      
//      if (request::getInstance()->hasFile('inputFile')) {
//        $type = array(
//            'image/png',
//            'image/jpeg',
//            'image/jpg',
//            'image/gif'
//        );
//        if(request::getInstance()->getFile('inputFile')['error'] !== 0) {
//          $flag = true;
//          session::getInstance()->setFlash('inputFile', true);
//          session::getInstance()->setError('Ocurrio un error en la carga de la imágen, por favor vuelva a intentarlo', 'inputFile');
//        } else if ((array_search(request::getInstance()->getFile('inputFile')['type'], $type) === false)) {
//          $flag = true;
//          session::getInstance()->setFlash('inputFile', true);
//          session::getInstance()->setError('Solo se permiten imágenes del tipo jpg, png o gif', 'inputFile');
//        } else if (request::getInstance()->getFile('inputFile')['size'] > config::getFileSizeAvatar()) {
//          $flag = true;
//          session::getInstance()->setFlash('inputFile', true);
//          session::getInstance()->setError('Solo se permiten imágenes con un tamaño máximo de 150kB', 'inputFile');
//        } else if ($flag === true) {
//          session::getInstance()->setFlash('inputFile', true);
//          session::getInstance()->setError('Debido a errores en el formulario, por favor vuelve a cargar la imagen que vas a usar', 'inputFile');
        }
      
      if ($flag === true) {
        //request::getInstance()->setMethod('GET');
        routing::getInstance()->forward('presupuestoHistorico', 'insert');
      }
    }
     public static function validateFiltroFecha($fechaInicial,$fechaFin) {
      
      if (strtotime($fechaFin) < strtotime($fechaInicial)){
        session::getInstance()->setError('La fecha final no puede ser menor a la actual', 'inputFecha');
          session::getInstance()->setFlash('modalFilters', true);
         
         // echo "<script> alert(' La fecha final no puede ser menor a la actual');</script>'";
      }       
    }
  }
}