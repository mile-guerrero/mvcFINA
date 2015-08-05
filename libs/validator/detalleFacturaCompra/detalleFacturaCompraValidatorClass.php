<?php
namespace mvc\validator {
  
  use mvc\validator\validatorClass;
  use mvc\session\sessionClass as session;
  use mvc\request\requestClass as request;
  use mvc\routing\routingClass as routing;
  use mvc\config\myConfigClass as config;
  /**
   * Description of manoObraValidatorClass
   *
   * @author Gonzalo Andres Bejarano, Elcy Milena Guerrero, Andres Eduardo Bahamon
   */
  class detalleFacturaCompraValidatorClass extends validatorClass {
    public static function validateInsert() {
      $flag = false;
      
      if (self::notBlank(request::getInstance()->getPost(\detalleFacturaCompraTableClass::getNameField(\detalleFacturaCompraTableClass::DESCRIPCION, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputDescripcion', true);
        session::getInstance()->setError('La descripcion es requerida', 'inputDescripcion');
      } 
        if (self::notBlank(request::getInstance()->getPost(\detalleFacturaCompraTableClass::getNameField(\detalleFacturaCompraTableClass::CANTIDAD, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputCantidad', true);
        session::getInstance()->setError('La cantidad es requerida', 'inputCantidad');
      } else if (!is_numeric(request::getInstance()->getPost(\detalleFacturaCompraTableClass::getNameField(\detalleFacturaCompraTableClass::CANTIDAD, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputCantidad', true);
        session::getInstance()->setError('La cantidad no puede ser letras', 'inputCantidad');
//      } else if(strlen(request::getInstance()->getPost(\detalleFacturaCompraTableClass::getNameField(\detalleFacturaCompraTableClass::VALOR_HORA, true))) > \detalleFacturaCompraTableClass::VALOR_HORA_LENGTH) {
//        $flag = true;
//        session::getInstance()->setFlash('inputValor', true);
//        session::getInstance()->setError('La catidad digitado sobre pasa los caracteres permitidos', 'inputValor');
      }
        if (self::notBlank(request::getInstance()->getPost(\detalleFacturaCompraTableClass::getNameField(\detalleFacturaCompraTableClass::VALOR_UNIDAD, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputValor', true);
        session::getInstance()->setError('El valor por cantidad es requerido', 'inputValor');
      } else if (!is_numeric(request::getInstance()->getPost(\detalleFacturaCompraTableClass::getNameField(\detalleFacturaCompraTableClass::VALOR_UNIDAD, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputValor', true);
        session::getInstance()->setError('El valor por cantidad no puede ser letras', 'inputValor');
      }
        if (self::notBlank(request::getInstance()->getPost(\detalleFacturaCompraTableClass::getNameField(\detalleFacturaCompraTableClass::VALOR_TOTAL, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputTotal', true);
        session::getInstance()->setError('El total es requerido', 'inputTotal');
      } else if (!is_numeric(request::getInstance()->getPost(\detalleFacturaCompraTableClass::getNameField(\detalleFacturaCompraTableClass::VALOR_TOTAL, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputTotal', true);
        session::getInstance()->setError('El total no puede ser letras', 'inputTotal');  
       
      }
      if ($flag === true) {
        //request::getInstance()->setMethod('GET');
        routing::getInstance()->forward('detalleFacturaCompra', 'insert');
      }
    }
     public static function validateFiltro() {
    //-------------------------------campo descripcion-----------------------------
//       
     
       
    }
  }
}