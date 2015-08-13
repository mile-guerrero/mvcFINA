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
  class loteValidatorClass extends validatorClass {
    public static function validateInsert() {
      $flag = false;
      
//      $soloNumeros = "/^[[:digit:]]+$/";
      $soloLetras = "/^[a-z]+$/i";
      $soloTelefono = "/^(\d{3,3}\-\d{3,3}\-\d{4,4})|^(\+\d\-\d{3,3}\-\d{4,4})/";
      $emailcorrecto = '/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/';
      
      //-------------------------------campo ubicacion-----------------------------
          //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\loteTableClass::getNameField(\loteTableClass::UBICACION, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputUbicacion', true);
        session::getInstance()->setError('La ubicacion del lote es requerido', 'inputUbicacion');
      } //----sobre pasar los caracteres----
        else if(strlen(request::getInstance()->getPost(\loteTableClass::getNameField(\loteTableClass::UBICACION, true))) > \loteTableClass::UBICACION_LENGTH) {
        $flag = true;
        session::getInstance()->setFlash('inputUbicacion', true);
        session::getInstance()->setError('La ubicacion digitada es mayor en cantidad de caracteres a lo permitido', 'inputUbicacion');
      }//-------------------------------campo ciudad-----------------------------
          //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\loteTableClass::getNameField(\loteTableClass::ID_CIUDAD, true)))) {
        $flag = true;
        session::getInstance()->setFlash('selectCiudad', true);
        session::getInstance()->setError('La ciudad del lote es requerido', 'selectCiudad');
        } //-------------------------------campo tamaño-----------------------------
          //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\loteTableClass::getNameField(\loteTableClass::TAMANO, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputTamano', true);
        session::getInstance()->setError('El tamaño del lote es requerido', 'inputTamano');
        } //----sobre pasar los caracteres----
        else if(strlen(request::getInstance()->getPost(\loteTableClass::getNameField(\loteTableClass::TAMANO, true))) > \loteTableClass::TAMANO_LENGTH) {
        $flag = true;
        session::getInstance()->setFlash('inputTamano', true);
        session::getInstance()->setError('El tamaño digitado es mayor en cantidad de caracteres a lo permitido', 'inputTamano');
      }  //----valida que sea numerico----      
        else if (!is_numeric(request::getInstance()->getPost(\loteTableClass::getNameField(\loteTableClass::TAMANO, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputTamano', true);
        session::getInstance()->setError('El tamaño no permite letras, solo numeros', 'inputTamano');
      }//-------------------------------campo unidad distancia-----------------------------
          //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\loteTableClass::getNameField(\loteTableClass::UNIDAD_DISTANCIA_ID, true)))) {
        $flag = true;
        session::getInstance()->setFlash('selectUnidad', true);
        session::getInstance()->setError('La unidad distancia del lote es requerido', 'selectUnidad');
        }//-------------------------------campo descripcion-----------------------------
          //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\loteTableClass::getNameField(\loteTableClass::DESCRIPCION, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputDescripcion', true);
        session::getInstance()->setError('La descripcion del lote es requerido', 'inputDescripcion');
      } //----sobre pasar los caracteres----
        else if(strlen(request::getInstance()->getPost(\loteTableClass::getNameField(\loteTableClass::DESCRIPCION, true))) > \loteTableClass::DESCRIPCION_LENGTH) {
        $flag = true;
        session::getInstance()->setFlash('inputDescripcion', true);
        session::getInstance()->setError('La descripcion digitada es mayor en cantidad de caracteres a lo permitido', 'inputDescripcion');
      }
      
      //-------------------------------condiccion de bandera true-----------------------------
      if ($flag === true) {
        //request::getInstance()->setMethod('GET');
        routing::getInstance()->forward('lote', 'insertLote');
      }
    }
  
  
  public static function validateEdit() {
      $flag = false;
      
//      $soloNumeros = "/^[[:digit:]]+$/";
      $soloLetras = "/^[a-z]+$/i";
      $soloTelefono = "/^(\d{3,3}\-\d{3,3}\-\d{4,4})|^(\+\d\-\d{3,3}\-\d{4,4})/";
      $emailcorrecto = '/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/';
      
      //-------------------------------campo ubicacion-----------------------------
          //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\loteTableClass::getNameField(\loteTableClass::UBICACION, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputUbicacion', true);
        session::getInstance()->setError('La ubicacion del lote es requerido', 'inputUbicacion');
      } //----sobre pasar los caracteres----
        else if(strlen(request::getInstance()->getPost(\loteTableClass::getNameField(\loteTableClass::UBICACION, true))) > \loteTableClass::UBICACION_LENGTH) {
        $flag = true;
        session::getInstance()->setFlash('inputUbicacion', true);
        session::getInstance()->setError('La ubicacion digitada es mayor en cantidad de caracteres a lo permitido', 'inputUbicacion');
      }//-------------------------------campo ciudad-----------------------------
          //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\loteTableClass::getNameField(\loteTableClass::ID_CIUDAD, true)))) {
        $flag = true;
        session::getInstance()->setFlash('selectCiudad', true);
        session::getInstance()->setError('La ciudad del lote es requerido', 'selectCiudad');
        } //-------------------------------campo tamaño-----------------------------
          //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\loteTableClass::getNameField(\loteTableClass::TAMANO, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputTamano', true);
        session::getInstance()->setError('El tamaño del lote es requerido', 'inputTamano');
        } //----sobre pasar los caracteres----
        else if(strlen(request::getInstance()->getPost(\loteTableClass::getNameField(\loteTableClass::TAMANO, true))) > \loteTableClass::TAMANO_LENGTH) {
        $flag = true;
        session::getInstance()->setFlash('inputTamano', true);
        session::getInstance()->setError('El tamaño digitado es mayor en cantidad de caracteres a lo permitido', 'inputTamano');
      }  //----valida que sea numerico----      
        else if (!is_numeric(request::getInstance()->getPost(\loteTableClass::getNameField(\loteTableClass::TAMANO, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputTamano', true);
        session::getInstance()->setError('El tamaño no permite letras, solo numeros', 'inputTamano');
      }//-------------------------------campo unidad distancia-----------------------------
          //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\loteTableClass::getNameField(\loteTableClass::UNIDAD_DISTANCIA_ID, true)))) {
        $flag = true;
        session::getInstance()->setFlash('selectUnidad', true);
        session::getInstance()->setError('La unidad distancia del lote es requerido', 'selectUnidad');
        }//-------------------------------campo descripcion-----------------------------
          //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\loteTableClass::getNameField(\loteTableClass::DESCRIPCION, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputDescripcion', true);
        session::getInstance()->setError('La descripcion del lote es requerido', 'inputDescripcion');
      } //----sobre pasar los caracteres----
        else if(strlen(request::getInstance()->getPost(\loteTableClass::getNameField(\loteTableClass::DESCRIPCION, true))) > \loteTableClass::DESCRIPCION_LENGTH) {
        $flag = true;
        session::getInstance()->setFlash('inputDescripcion', true);
        session::getInstance()->setError('La descripcion digitada es mayor en cantidad de caracteres a lo permitido', 'inputDescripcion');
      }

      //-------------------------------condiccion de bandera true-----------------------------
      if ($flag === true) {
        request::getInstance()->setMethod('GET');
        request::getInstance()->addParamGet(array(\loteTableClass::ID => request::getInstance()->getPost(\loteTableClass::getNameField(\loteTableClass::ID, true))));
        routing::getInstance()->forward('lote', 'editLote');
      
      }
    }
       
    
    
    public static function validateEditMas() {
      $flag = false;
      
      $soloNumeros = "/^[[:digit:]]+$/";
      $soloLetras = "/^[a-z]+$/i";
      $soloTelefono = "/^(\d{3,3}\-\d{3,3}\-\d{4,4})|^(\+\d\-\d{3,3}\-\d{4,4})/";
      $emailcorrecto = '/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/';
      
      //-------------------------------campo plantulas a sembrar---------------
         //----sobre pasar los caracteres----
        if(strlen(request::getInstance()->getPost(\loteTableClass::getNameField(\loteTableClass::NUMERO_PLANTULAS, true))) > \loteTableClass::NUMERO_PLANTULAS_LENGTH) {
        $flag = true;
        session::getInstance()->setFlash('inputPlantulas', true);
        session::getInstance()->setError('La cantidad de plantulas es mayor en cantidad de caracteres a lo permitido', 'inputPlantulas');
      }  //----valida que sea numerico----      
//        else if (!is_numeric(request::getInstance()->getPost(\loteTableClass::getNameField(\loteTableClass::NUMERO_PLANTULAS, true)))) {
//        $flag = true;
//        session::getInstance()->setFlash('inputPlantulas', true);
//        session::getInstance()->setError('La cantidad de plantulas a sembrar no permite letras, solo numeros', 'inputPlantulas');
//      } //-------------------------------campo presupuesto---------------
       //----sobre pasar los caracteres----
         if(strlen(request::getInstance()->getPost(\loteTableClass::getNameField(\loteTableClass::PRESUPUESTO, true))) > \loteTableClass::PRESUPUESTO_LENGTH) {
        $flag = true;
        session::getInstance()->setFlash('inputPresupuesto', true);
        session::getInstance()->setError('El presupuesto digitado es mayor en cantidad de caracteres a lo permitido', 'inputPresupuesto');
      }  //----valida que sea numerico----      
//      else if (!is_numeric(request::getInstance()->getPost(\loteTableClass::getNameField(\loteTableClass::PRESUPUESTO, true)))) {
//        $flag = true;
//        session::getInstance()->setFlash('inputPresupuesto', true);
//        session::getInstance()->setError('El presupuesto no permite letras, solo numeros', 'inputPresupuesto');
//      }
      if(strlen(request::getInstance()->getPost(\loteTableClass::getNameField(\loteTableClass::PRODUCCION, true))) > \loteTableClass::PRODUCCION_LENGTH) {
        $flag = true;
        session::getInstance()->setFlash('inputProduccion', true);
        session::getInstance()->setError('La produccion digitado es mayor en cantidad de caracteres a lo permitido', 'inputProduccion');
      }     
      //-------------------------------condiccion de bandera true-----------------------------
      if ($flag === true) {
        request::getInstance()->setMethod('GET');
        request::getInstance()->addParamGet(array(\loteTableClass::ID => request::getInstance()->getPost(\loteTableClass::getNameField(\loteTableClass::ID, true))));
        routing::getInstance()->forward('lote', 'editLoteMas');
      
      }
    }
     public static function validateFiltro() {
        
      if(strlen(request::getInstance()->getPost(\loteTableClass::getNameField(\loteTableClass::UBICACION, true))) > \loteTableClass::UBICACION_LENGTH) {
       session::getInstance()->setError('La ubicacion digitada es mayor en cantidad de caracteres a lo permitido', 'inputUbicacion');
      session::getInstance()->setFlash('modalFilters', true);
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