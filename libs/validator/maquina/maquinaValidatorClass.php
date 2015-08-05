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
  class maquinaValidatorClass extends validatorClass {
    public static function validateInsert() {
      $flag = false;
      
//      $soloNumeros = "/^[[:digit:]]+$/";
      $soloLetras = "/^[a-z]+$/i";
      $soloTelefono = "/^(\d{3,3}\-\d{3,3}\-\d{4,4})|^(\+\d\-\d{3,3}\-\d{4,4})/";
      $emailcorrecto = '/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/';
      
      //-------------------------------campo nombre-----------------------------
          //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\maquinaTableClass::getNameField(\maquinaTableClass::NOMBRE, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputNombre', true);
        session::getInstance()->setError('El nombre de la maquina es requerido', 'inputNombre');
      } //----sobre pasar los caracteres----
        else if(strlen(request::getInstance()->getPost(\maquinaTableClass::getNameField(\maquinaTableClass::NOMBRE, true))) > \maquinaTableClass::NOMBRE_LENGTH) {
        $flag = true;
        session::getInstance()->setFlash('inputNombre', true);
        session::getInstance()->setError('El nombre digitado es mayor en cantidad de caracteres a lo permitido', 'inputNombre');
      }//-------------------------------campo descripcion-----------------------------
          //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\maquinaTableClass::getNameField(\maquinaTableClass::DESCRIPCION, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputDescripcion', true);
        session::getInstance()->setError('La descripcion de la maquina es requerido', 'inputDescripcion');
      } //----sobre pasar los caracteres----
        else if(strlen(request::getInstance()->getPost(\maquinaTableClass::getNameField(\maquinaTableClass::DESCRIPCION, true))) > \maquinaTableClass::DESCRIPCION_LENGTH) {
        $flag = true;
        session::getInstance()->setFlash('inputDescripcion', true);
        session::getInstance()->setError('La descripcion digitada es mayor en cantidad de caracteres a lo permitido', 'inputDescripcion');
      }//-------------------------------campo origen maquina-----------------------------
          //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\maquinaTableClass::getNameField(\maquinaTableClass::ORIGEN_MAQUINA, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputOrigen', true);
        session::getInstance()->setError('El origen de la maquina  es requerido', 'inputOrigen');
      } //----sobre pasar los caracteres----
        else if(strlen(request::getInstance()->getPost(\maquinaTableClass::getNameField(\maquinaTableClass::ORIGEN_MAQUINA, true))) > \maquinaTableClass::ORIGEN_MAQUINA_LENGTH) {
        $flag = true;
        session::getInstance()->setFlash('inputOrigen', true);
        session::getInstance()->setError('El origen de la maquina digitada es mayor en cantidad de caracteres a lo permitido', 'inputOrigen');
      }else if (!preg_match($soloLetras, (request::getInstance()->getPost(\maquinaTableClass::getNameField(\maquinaTableClass::ORIGEN_MAQUINA, true))))) {
       $flag = true;
        session::getInstance()->setFlash('inputOrigen', true);
        session::getInstance()->setError('El origen no permite letras, solo numeros', 'inputOrigen');
      }//-------------------------------campotipo uso maquina-----------------------------
          //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\maquinaTableClass::getNameField(\maquinaTableClass::TIPO_USO_ID, true)))) {
        $flag = true;
        session::getInstance()->setFlash('selectTipo', true);
        session::getInstance()->setError('El tipo uso de la maquina es requerido', 'selectTipo');
        }//-------------------------------campo proveedor-----------------------------
          //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\maquinaTableClass::getNameField(\maquinaTableClass::PROVEEDOR_ID, true)))) {
        $flag = true;
        session::getInstance()->setFlash('selectProveedor', true);
        session::getInstance()->setError('El proveedor de la maquina es requerido', 'selectProveedor');
        }
      
      //-------------------------------condiccion de bandera true-----------------------------
      if ($flag === true) {
        //request::getInstance()->setMethod('GET');
        routing::getInstance()->forward('maquina', 'insertMaquina');
      }
    }
  
  
  public static function validateEdit() {
       $flag = false;
      
//      $soloNumeros = "/^[[:digit:]]+$/";
      $soloLetras = "/^[a-z]+$/i";
      $soloTelefono = "/^(\d{3,3}\-\d{3,3}\-\d{4,4})|^(\+\d\-\d{3,3}\-\d{4,4})/";
      $emailcorrecto = '/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/';
      
      //-------------------------------campo nombre-----------------------------
          //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\maquinaTableClass::getNameField(\maquinaTableClass::NOMBRE, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputNombre', true);
        session::getInstance()->setError('El nombre de la maquina es requerido', 'inputNombre');
      } //----sobre pasar los caracteres----
        else if(strlen(request::getInstance()->getPost(\maquinaTableClass::getNameField(\maquinaTableClass::NOMBRE, true))) > \maquinaTableClass::NOMBRE_LENGTH) {
        $flag = true;
        session::getInstance()->setFlash('inputNombre', true);
        session::getInstance()->setError('El nombre digitado es mayor en cantidad de caracteres a lo permitido', 'inputNombre');
      }//-------------------------------campo descripcion-----------------------------
          //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\maquinaTableClass::getNameField(\maquinaTableClass::DESCRIPCION, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputDescripcion', true);
        session::getInstance()->setError('La descripcion de la maquina es requerido', 'inputDescripcion');
      } //----sobre pasar los caracteres----
        else if(strlen(request::getInstance()->getPost(\maquinaTableClass::getNameField(\maquinaTableClass::DESCRIPCION, true))) > \maquinaTableClass::DESCRIPCION_LENGTH) {
        $flag = true;
        session::getInstance()->setFlash('inputDescripcion', true);
        session::getInstance()->setError('La descripcion digitada es mayor en cantidad de caracteres a lo permitido', 'inputDescripcion');
      }//-------------------------------campo origen maquina-----------------------------
          //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\maquinaTableClass::getNameField(\maquinaTableClass::ORIGEN_MAQUINA, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputOrigen', true);
        session::getInstance()->setError('El origen de la maquina  es requerido', 'inputOrigen');
      } //----sobre pasar los caracteres----
        else if(strlen(request::getInstance()->getPost(\maquinaTableClass::getNameField(\maquinaTableClass::ORIGEN_MAQUINA, true))) > \maquinaTableClass::ORIGEN_MAQUINA_LENGTH) {
        $flag = true;
        session::getInstance()->setFlash('inputOrigen', true);
        session::getInstance()->setError('El origen de la maquina digitada es mayor en cantidad de caracteres a lo permitido', 'inputOrigen');
      }else if (!preg_match($soloLetras, (request::getInstance()->getPost(\maquinaTableClass::getNameField(\maquinaTableClass::ORIGEN_MAQUINA, true))))) {
       $flag = true;
        session::getInstance()->setFlash('inputOrigen', true);
        session::getInstance()->setError('El origen no permite letras, solo numeros', 'inputOrigen');
      }//-------------------------------campotipo uso maquina-----------------------------
          //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\maquinaTableClass::getNameField(\maquinaTableClass::TIPO_USO_ID, true)))) {
        $flag = true;
        session::getInstance()->setFlash('selectTipo', true);
        session::getInstance()->setError('El tipo uso de la maquina es requerido', 'selectTipo');
        }//-------------------------------campo proveedor-----------------------------
          //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\maquinaTableClass::getNameField(\maquinaTableClass::PROVEEDOR_ID, true)))) {
        $flag = true;
        session::getInstance()->setFlash('selectProveedor', true);
        session::getInstance()->setError('El proveedor de la maquina es requerido', 'selectProveedor');
        }
      //-------------------------------condiccion de bandera true-----------------------------
      if ($flag === true) {
        request::getInstance()->setMethod('GET');
        request::getInstance()->addParamGet(array(\maquinaTableClass::ID => request::getInstance()->getPost(\maquinaTableClass::getNameField(\maquinaTableClass::ID, true))));
        routing::getInstance()->forward('maquina', 'editMaquina');
      
      }
    }
   public static function validateFiltro() {
        $soloLetras = "/^[a-z]+$/i";
      $soloTelefono = "/^(\d{3,3}\-\d{3,3}\-\d{4,4})|^(\+\d\-\d{3,3}\-\d{4,4})/";
      $emailcorrecto = '/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/';
      
      if(strlen(request::getInstance()->getPost(\maquinaTableClass::getNameField(\maquinaTableClass::NOMBRE, true))) > \maquinaTableClass::NOMBRE_LENGTH) {
        session::getInstance()->setError('El nombre digitado es mayor en cantidad de caracteres a lo permitido', 'inputNombre');
      }
       
    }
    
     public static function validateFiltroDescripcion() {
        $soloLetras = "/^[a-z]+$/i";
      $soloTelefono = "/^(\d{3,3}\-\d{3,3}\-\d{4,4})|^(\+\d\-\d{3,3}\-\d{4,4})/";
      $emailcorrecto = '/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/';
      
      if (self::notBlank(request::getInstance()->getPost(\maquinaTableClass::getNameField(\maquinaTableClass::DESCRIPCION, true)))) {
        session::getInstance()->setError('La descripcion de la maquina es requerido', 'inputDescripcion');
      } //----sobre pasar los caracteres----
        else if(strlen(request::getInstance()->getPost(\maquinaTableClass::getNameField(\maquinaTableClass::DESCRIPCION, true))) > \maquinaTableClass::DESCRIPCION_LENGTH) {
        session::getInstance()->setError('La descripcion digitada es mayor en cantidad de caracteres a lo permitido', 'inputDescripcion');
      }//----sobre pasar los caracteres----
        if(strlen(request::getInstance()->getPost(\maquinaTableClass::getNameField(\maquinaTableClass::ORIGEN_MAQUINA, true))) > \maquinaTableClass::ORIGEN_MAQUINA_LENGTH) {
        session::getInstance()->setError('El origen de la maquina digitada es mayor en cantidad de caracteres a lo permitido', 'inputOrigen');
      }else if (!preg_match($soloLetras, (request::getInstance()->getPost(\maquinaTableClass::getNameField(\maquinaTableClass::ORIGEN_MAQUINA, true))))) {
        session::getInstance()->setError('El origen no permite letras, solo numeros', 'inputOrigen');
      }
       
    }
    
     public static function validateFiltroOrigen() {
        $soloLetras = "/^[a-z]+$/i";
      $soloTelefono = "/^(\d{3,3}\-\d{3,3}\-\d{4,4})|^(\+\d\-\d{3,3}\-\d{4,4})/";
      $emailcorrecto = '/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/';
      
      if(strlen(request::getInstance()->getPost(\maquinaTableClass::getNameField(\maquinaTableClass::ORIGEN_MAQUINA, true))) > \maquinaTableClass::ORIGEN_MAQUINA_LENGTH) {
        session::getInstance()->setError('El origen de la maquina digitada es mayor en cantidad de caracteres a lo permitido', 'inputOrigen');
      }else if (!preg_match($soloLetras, (request::getInstance()->getPost(\maquinaTableClass::getNameField(\maquinaTableClass::ORIGEN_MAQUINA, true))))) {
        session::getInstance()->setError('El origen no permite letras, solo numeros', 'inputOrigen');
      }
       
    }
  }
  
}