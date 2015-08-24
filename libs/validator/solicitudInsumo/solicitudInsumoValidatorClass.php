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
  class solicitudInsumoValidatorClass extends validatorClass {
    public static function validateInsert() {
      $flag = false;
      
      if (self::notBlank(request::getInstance()->getPost(\solicitudInsumoTableClass::getNameField(\solicitudInsumoTableClass::CANTIDAD, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputCantidad', true);
        session::getInstance()->setError('La cantidad es requerida', 'inputCantidad');
      } else if (!is_numeric(request::getInstance()->getPost(\solicitudInsumoTableClass::getNameField(\solicitudInsumoTableClass::CANTIDAD, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputCantidad', true);
        session::getInstance()->setError('La cantidad no puede ser letras', 'inputCantidad');
      } else if(strlen(request::getInstance()->getPost(\solicitudInsumoTableClass::getNameField(\solicitudInsumoTableClass::CANTIDAD, true))) > \solicitudInsumoTableClass::CANTIDAD_LENGTH) {
        $flag = true;
        session::getInstance()->setFlash('inputCantidad', true);
        session::getInstance()->setError('La catidad digitado sobre pasa los caracteres permitidos', 'inputCantidad');

        //-------------------------------campo Trabajador-----------------------------
          //----campo nulo----
      } if (self::notBlank(request::getInstance()->getPost(\solicitudInsumoTableClass::getNameField(\solicitudInsumoTableClass::TRABAJADOR_ID, true)))) {
        $flag = true;
        session::getInstance()->setFlash('selectTrabajador', true);
        session::getInstance()->setError('El trabajador es requerido', 'selectTrabajador');
        //-------------------------------campo Producto-----------------------------
          //----campo nulo----
      } if (self::notBlank(request::getInstance()->getPost(\solicitudInsumoTableClass::getNameField(\solicitudInsumoTableClass::PRODUCTO_INSUMO_ID, true)))) {
        $flag = true;
        session::getInstance()->setFlash('selectProducto', true);
        session::getInstance()->setError('El producto es requerido', 'selectProducto');
        
        //-------------------------------campo Lote-----------------------------
          //----campo nulo----
      } if (self::notBlank(request::getInstance()->getPost(\solicitudInsumoTableClass::getNameField(\solicitudInsumoTableClass::LOTE_ID, true)))) {
        $flag = true;
        session::getInstance()->setFlash('selectLote', true);
        session::getInstance()->setError('El lote es requerido', 'selectLote');
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
        routing::getInstance()->forward('solicitudInsumo', 'insert');
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