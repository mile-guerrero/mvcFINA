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
  class detalleFacturaVentaValidatorUpdateClass extends validatorClass {
    public static function validateUpdate() {
      $flag = false;
      
      if (self::notBlank(request::getInstance()->getPost(\detalleFacturaVentaTableClass::getNameField(\detalleFacturaVentaTableClass::DESCRIPCION, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputDescripcion', true);
        session::getInstance()->setError('La descripcion es requerida', 'inputDescripcion');
      } else if (is_numeric(request::getInstance()->getPost(\detalleFacturaVentaTableClass::getNameField(\detalleFacturaVentaTableClass::DESCRIPCION, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputDescripcion', true);
        session::getInstance()->setError('La descripcion no puede ser numeros', 'inputDescripcion');
//      } else if(strlen(request::getInstance()->getPost(\detalleFacturaVentaTableClass::getNameField(\detalleFacturaVentaTableClass::DESCRIPCION, true))) > \detalleFacturaVentaTableClass::CANTIDAD_HORA_LENGTH) {
//        $flag = true;
//        session::getInstance()->setFlash('inputCantidad', true);
//        session::getInstance()->setError('La catidad digitado sobre pasa los caracteres permitidos', 'inputCantidad');
      }
        if (self::notBlank(request::getInstance()->getPost(\detalleFacturaVentaTableClass::getNameField(\detalleFacturaVentaTableClass::CANTIDAD, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputCantidad', true);
        session::getInstance()->setError('La cantidad es requerida', 'inputCantidad');
      } else if (!is_numeric(request::getInstance()->getPost(\detalleFacturaVentaTableClass::getNameField(\detalleFacturaVentaTableClass::CANTIDAD, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputCantidad', true);
        session::getInstance()->setError('La cantidad no puede ser letras', 'inputCantidad');
//      } else if(strlen(request::getInstance()->getPost(\detalleFacturaVentaTableClass::getNameField(\detalleFacturaVentaTableClass::VALOR_HORA, true))) > \detalleFacturaVentaTableClass::VALOR_HORA_LENGTH) {
//        $flag = true;
//        session::getInstance()->setFlash('inputValor', true);
//        session::getInstance()->setError('La catidad digitado sobre pasa los caracteres permitidos', 'inputValor');
      }
        if (self::notBlank(request::getInstance()->getPost(\detalleFacturaVentaTableClass::getNameField(\detalleFacturaVentaTableClass::VALOR_UNIDAD, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputValor', true);
        session::getInstance()->setError('El valor por cantidad es requerido', 'inputValor');
      } else if (!is_numeric(request::getInstance()->getPost(\detalleFacturaVentaTableClass::getNameField(\detalleFacturaVentaTableClass::VALOR_UNIDAD, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputValor', true);
        session::getInstance()->setError('El valor por cantidad no puede ser letras', 'inputValor');
      }
        if (self::notBlank(request::getInstance()->getPost(\detalleFacturaVentaTableClass::getNameField(\detalleFacturaVentaTableClass::VALOR_TOTAL, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputTotal', true);
        session::getInstance()->setError('El total es requerido', 'inputTotal');
      } else if (!is_numeric(request::getInstance()->getPost(\detalleFacturaVentaTableClass::getNameField(\detalleFacturaVentaTableClass::VALOR_TOTAL, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputTotal', true);
        session::getInstance()->setError('El total no puede ser letras', 'inputTotal');  
       
        //-------------------------------campo Cliente-----------------------------
          //----campo nulo----
      } if (self::notBlank(request::getInstance()->getPost(\detalleFacturaVentaTableClass::getNameField(\detalleFacturaVentaTableClass::CLIENTE_ID, true)))) {
        $flag = true;
        session::getInstance()->setFlash('selectCliente', true);
        session::getInstance()->setError('El cliente es requerido', 'selectCliente');
      
//      } else if(strlen(request::getInstance()->getPost('inputCantidad')) > \detalleFacturaVentaTableClass::CANTIDAD_HORA_LENGTH) {
//        $flag = true;
//        session::getInstance()->setFlash('inputCantidad', true);
//        session::getInstance()->setError('El usuario digitado es mayor en cantidad de caracteres a lo permitido', 'inputCantidad');
//      } else if(self::isUnique(\usuarioTableClass::ID, true, array(\detalleFacturaVentaTableClass::CANTIDAD_HORA_LENGTH => request::getInstance()->getPost('inputCantidad')), \usuarioTableClass::getNameTable())) {
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
        request::getInstance()->setMethod('GET');
        request::getInstance()->addParamGet(array(\detalleFacturaVentaTableClass::ID => request::getInstance()->getPost(\detalleFacturaVentaTableClass::getNameField(\detalleFacturaVentaTableClass::ID, true))));
        routing::getInstance()->forward('detalleFacturaVenta', 'edit');
      }
    }
  }
}