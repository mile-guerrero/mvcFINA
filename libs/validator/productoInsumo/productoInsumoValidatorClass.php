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
   * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
   */
  class productoInsumoValidatorClass extends validatorClass {
    public static function validateInsert() {
       
      
      
      $flag = false;
      
//      $soloNumeros = "/^[[:digit:]]+$/";
      $soloLetras = "/^[a-z]+$/i";
      $soloTelefono = "/^(\d{3,3}\-\d{3,3}\-\d{4,4})|^(\+\d\-\d{3,3}\-\d{4,4})/";
      $emailcorrecto = '/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/';
      
      //-------------------------------campo descripcion-----------------------------
          //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\productoInsumoTableClass::getNameField(\productoInsumoTableClass::DESCRIPCION, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputDescripcion', true);
        session::getInstance()->setError('La descripcion del insumo es requerido', 'inputDescripcion');
      } //----sobre pasar los caracteres----
        else if(strlen(request::getInstance()->getPost(\productoInsumoTableClass::getNameField(\productoInsumoTableClass::DESCRIPCION, true))) > \productoInsumoTableClass::DESCRIPCION_LENGTH) {
        $flag = true;
        session::getInstance()->setFlash('inputDescripcion', true);
        session::getInstance()->setError('La descripcion digitada es mayor en cantidad de caracteres a lo permitido', 'inputDescripcion');
      }//-------------------------------campo cantidad-----------------------------
          //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\productoInsumoTableClass::getNameField(\productoInsumoTableClass::CANTIDAD, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputCantidad', true);
        session::getInstance()->setError('La cantidad del insumo es requerido', 'inputCantidad');
        } //----sobre pasar los caracteres----
        else if(strlen(request::getInstance()->getPost(\productoInsumoTableClass::getNameField(\productoInsumoTableClass::CANTIDAD, true))) > \productoInsumoTableClass::CANTIDAD_LENGTH) {
        $flag = true;
        session::getInstance()->setFlash('inputCantidad', true);
        session::getInstance()->setError('La cantidad digitada es mayor en cantidad de caracteres a lo permitido', 'inputCantidad');
      }  //----valida que sea numerico----      
        else if (!is_numeric(request::getInstance()->getPost(\productoInsumoTableClass::getNameField(\productoInsumoTableClass::CANTIDAD, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputCantidad', true);
        session::getInstance()->setError('La cantidad no permite letras, solo numeros', 'inputCantidad');
//      } //-------------------------------campo iva-----------------------------
//          //----campo nulo----
//      if (self::notBlank(request::getInstance()->getPost(\productoInsumoTableClass::getNameField(\productoInsumoTableClass::IVA, true)))) {
//        $flag = true;
//        session::getInstance()->setFlash('inputIva', true);
//        session::getInstance()->setError('El iva del insumo es requerido', 'inputIva');
//        } //----sobre pasar los caracteres----
//        else if(strlen(request::getInstance()->getPost(\productoInsumoTableClass::getNameField(\productoInsumoTableClass::IVA, true))) > \productoInsumoTableClass::IVA_LENGTH) {
//        $flag = true;
//        session::getInstance()->setFlash('inputIva', true);
//        session::getInstance()->setError('El iva digitado es mayor en cantidad de caracteres a lo permitido', 'inputIva');
//      }  //----valida que sea numerico----      
//        else if (!is_numeric(request::getInstance()->getPost(\productoInsumoTableClass::getNameField(\productoInsumoTableClass::IVA, true)))) {
//        $flag = true;
//        session::getInstance()->setFlash('inputIva', true);
//        session::getInstance()->setError('El iva no permite letras, solo numeros', 'inputIva');
//      }//-------------------------------campo unidad medida-----------------------------
        } //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\productoInsumoTableClass::getNameField(\productoInsumoTableClass::UNIDAD_MEDIDA_ID, true)))) {
        $flag = true;
        session::getInstance()->setFlash('selectUnidad', true);
        session::getInstance()->setError('La unidad medida del insumo es requerido', 'selectUnidad');
        }//-------------------------------campo tipo producto insumo-----------------------------
          //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\productoInsumoTableClass::getNameField(\productoInsumoTableClass::TIPO_PRODUCTO_INSUMO_ID, true)))) {
        $flag = true;
        session::getInstance()->setFlash('selectTipo', true);
        session::getInstance()->setError('El tipo insumo del insumo es requerido', 'selectTipo');
        }
        
        
      
      //-------------------------------condiccion de bandera true-----------------------------
      if ($flag === true) {
        //request::getInstance()->setMethod('GET');
        routing::getInstance()->forward('productoInsumo', 'insertProductoInsumo');
      }
      
    }
  
  
  public static function validateEdit() {
       $flag = false;
      
//      $soloNumeros = "/^[[:digit:]]+$/";
      $soloLetras = "/^[a-z]+$/i";
      $soloTelefono = "/^(\d{3,3}\-\d{3,3}\-\d{4,4})|^(\+\d\-\d{3,3}\-\d{4,4})/";
      $emailcorrecto = '/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/';
      
      //-------------------------------campo descripcion-----------------------------
          //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\productoInsumoTableClass::getNameField(\productoInsumoTableClass::DESCRIPCION, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputDescripcion', true);
        session::getInstance()->setError('La descripcion del insumo es requerido', 'inputDescripcion');
      } //----sobre pasar los caracteres----
        else if(strlen(request::getInstance()->getPost(\productoInsumoTableClass::getNameField(\productoInsumoTableClass::DESCRIPCION, true))) > \productoInsumoTableClass::DESCRIPCION_LENGTH) {
        $flag = true;
        session::getInstance()->setFlash('inputDescripcion', true);
        session::getInstance()->setError('La descripcion digitada es mayor en cantidad de caracteres a lo permitido', 'inputDescripcion');
      }//-------------------------------campo cantidad-----------------------------
          //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\productoInsumoTableClass::getNameField(\productoInsumoTableClass::CANTIDAD, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputCantidad', true);
        session::getInstance()->setError('La cantidad del insumo es requerido', 'inputCantidad');
        } //----sobre pasar los caracteres----
        else if(strlen(request::getInstance()->getPost(\productoInsumoTableClass::getNameField(\productoInsumoTableClass::CANTIDAD, true))) > \productoInsumoTableClass::CANTIDAD_LENGTH) {
        $flag = true;
        session::getInstance()->setFlash('inputCantidad', true);
        session::getInstance()->setError('La cantidad digitada es mayor en cantidad de caracteres a lo permitido', 'inputCantidad');
      }  //----valida que sea numerico----      
        else if (!is_numeric(request::getInstance()->getPost(\productoInsumoTableClass::getNameField(\productoInsumoTableClass::CANTIDAD, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputCantidad', true);
        session::getInstance()->setError('La cantidad no permite letras, solo numeros', 'inputCantidad');
      }//-------------------------------campo file-----------------------------
          //----campo nulo----
//      if ((request::getInstance()->getFile(\productoInsumoTableClass::getNameField(\productoInsumoTableClass::NOMBRE_IMAGEN, true)))) {
//        $flag = true;
//        session::getInstance()->setFlash('inputImagen', true);
//        session::getInstance()->setError('El peso de la imagen sobre pasa el peso maximo permitido', 'inputImagen');
//     
//        
//        } //-------------------------------campo iva-----------------------------
          //----campo nulo----
//      if (self::notBlank(request::getInstance()->getPost(\productoInsumoTableClass::getNameField(\productoInsumoTableClass::IVA, true)))) {
//        $flag = true;
//        session::getInstance()->setFlash('inputIva', true);
//        session::getInstance()->setError('El iva del insumo es requerido', 'inputIva');
//        } //----sobre pasar los caracteres----
//        else if(strlen(request::getInstance()->getPost(\productoInsumoTableClass::getNameField(\productoInsumoTableClass::IVA, true))) > \productoInsumoTableClass::IVA_LENGTH) {
//        $flag = true;
//        session::getInstance()->setFlash('inputIva', true);
//        session::getInstance()->setError('El iva digitado es mayor en cantidad de caracteres a lo permitido', 'inputIva');
//      }  //----valida que sea numerico----      
//        else if (!is_numeric(request::getInstance()->getPost(\productoInsumoTableClass::getNameField(\productoInsumoTableClass::IVA, true)))) {
//        $flag = true;
//        session::getInstance()->setFlash('inputIva', true);
//        session::getInstance()->setError('El iva no permite letras, solo numeros', 'inputIva');
//      }//-------------------------------campo unidad medida-----------------------------
          //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\productoInsumoTableClass::getNameField(\productoInsumoTableClass::UNIDAD_MEDIDA_ID, true)))) {
        $flag = true;
        session::getInstance()->setFlash('selectUnidad', true);
        session::getInstance()->setError('La unidad medida del insumo es requerido', 'selectUnidad');
        }//-------------------------------campo tipo producto insumo-----------------------------
          //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\productoInsumoTableClass::getNameField(\productoInsumoTableClass::TIPO_PRODUCTO_INSUMO_ID, true)))) {
        $flag = true;
        session::getInstance()->setFlash('selectTipo', true);
        session::getInstance()->setError('El tipo insumo del insumo es requerido', 'selectTipo');
        }
      //-------------------------------condiccion de bandera true-----------------------------
      if ($flag === true) {
        request::getInstance()->setMethod('GET');
        request::getInstance()->addParamGet(array(\productoInsumoTableClass::ID => request::getInstance()->getPost(\productoInsumoTableClass::getNameField(\productoInsumoTableClass::ID, true))));
        routing::getInstance()->forward('productoInsumo', 'editProductoInsumo');
      
      }
    }
  }
}