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
  class clienteValidatorClass extends validatorClass {
    public static function validateInsert() {
      $flag = false;
//      $soloNumeros = "/^[[:digit:]]+$/";
      $soloLetras = "/^[a-z]+$/i";
      $soloTelefono = "/^(\d{3,3}\-\d{3,3}\-\d{4,4})|^(\+\d\-\d{3,3}\-\d{4,4})/";
      $emailcorrecto = '/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/';
      
      //------------------------------------campo documento---------------------
        //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\clienteTableClass::getNameField(\clienteTableClass::DOCUMENTO, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputDocumento', true);
        session::getInstance()->setError('El documento del cliente es requerido', 'inputDocumento');
      } //----solo numeros----
        
        else if (!is_numeric(request::getInstance()->getPost(\clienteTableClass::getNameField(\clienteTableClass::DOCUMENTO, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputDocumento', true);
        session::getInstance()->setError('El documento no permite letras, solo numeros', 'inputDocumento');
      } //----sobre pasar los caracteres----
        else if(strlen(request::getInstance()->getPost(\clienteTableClass::getNameField(\clienteTableClass::DOCUMENTO, true))) > \clienteTableClass::DOCUMENTO_LENGTH) {
        $flag = true;
        session::getInstance()->setFlash('inputDocumento', true);
        session::getInstance()->setError('El documento digitado es mayor en cantidad de caracteres a lo permitido', 'inputDocumento');
      } //----datos duplicados----
      else if (self::isUnique(\clienteTableClass::ID, true, array(\clienteTableClass::DOCUMENTO => request::getInstance()->getPost(\clienteTableClass::getNameField(\clienteTableClass::DOCUMENTO, true))), \clienteTableClass::getNameTable())) {
                $flag = true;
                session::getInstance()->setFlash('inputDocumento', true);
                session::getInstance()->setError('El documento digitado ya existe', 'inputDocumento');
            }
      
      //-------------------------------campo nombre-----------------------------
          //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\clienteTableClass::getNameField(\clienteTableClass::NOMBRE, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputNombre', true);
        session::getInstance()->setError('El nombre del cliente es requerido', 'inputNombre');
      } //----solo permitir letras----
        else if (!preg_match($soloLetras, (request::getInstance()->getPost(\clienteTableClass::getNameField(\clienteTableClass::NOMBRE, true))))){
        $flag = true;
        session::getInstance()->setFlash('inputNombre', true);
        session::getInstance()->setError('El nombre no permite numeros, solo letras', 'inputNombre');
      } //----sobre pasar los caracteres----
        else if(strlen(request::getInstance()->getPost(\clienteTableClass::getNameField(\clienteTableClass::NOMBRE, true))) > \clienteTableClass::NOMBRE_LENGTH) {
        $flag = true;
        session::getInstance()->setFlash('inputNombre', true);
        session::getInstance()->setError('El nombre digitado es mayor en cantidad de caracteres a lo permitido', 'inputNombre');
      }

   //-------------------------------campo apellido-----------------------------
          //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\clienteTableClass::getNameField(\clienteTableClass::APELLIDO, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputApellido', true);
        session::getInstance()->setError('El apellido del cliente es requerido', 'inputApellido');
      } //----solo permitir letras----
        else if (!preg_match($soloLetras, (request::getInstance()->getPost(\clienteTableClass::getNameField(\clienteTableClass::APELLIDO, true))))){
        $flag = true;
        session::getInstance()->setFlash('inputApellido', true);
        session::getInstance()->setError('El apellido no permite numeros, solo letras', 'inputApellido');
      } //----sobre pasar los caracteres----
        else if(strlen(request::getInstance()->getPost(\clienteTableClass::getNameField(\clienteTableClass::APELLIDO, true))) > \clienteTableClass::APELLIDO_LENGTH) {
        $flag = true;
        session::getInstance()->setFlash('inputApellido', true);
        session::getInstance()->setError('El apellido digitado es mayor en cantidad de caracteres a lo permitido', 'inputApellido');
      }   
      
      
    //-------------------------------campo direccion-----------------------------
          //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\clienteTableClass::getNameField(\clienteTableClass::DIRECCION, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputDireccion', true);
        session::getInstance()->setError('La direccion del cliente es requerido', 'inputDireccion');
        } //----sobre pasar los caracteres----
        else if(strlen(request::getInstance()->getPost(\clienteTableClass::getNameField(\clienteTableClass::DIRECCION, true))) > \clienteTableClass::DIRECCION_LENGTH) {
        $flag = true;
        session::getInstance()->setFlash('inputDireccion', true);
        session::getInstance()->setError('La direccion digitada es mayor en cantidad de caracteres a lo permitido', 'inputDireccion');
      }
      
    //-------------------------------campo telefono-----------------------------
          //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\clienteTableClass::getNameField(\clienteTableClass::TELEFONO, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputTelefono', true);
        session::getInstance()->setError('El telefono del cliente es requerido', 'inputTelefono');
        } //----sobre pasar los caracteres----
        else if(strlen(request::getInstance()->getPost(\clienteTableClass::getNameField(\clienteTableClass::TELEFONO, true))) > \clienteTableClass::TELEFONO_LENGTH) {
        $flag = true;
        session::getInstance()->setFlash('inputTelefono', true);
        session::getInstance()->setError('El telefono digitado es mayor en cantidad de caracteres a lo permitido', 'inputTelefono');
      }  //----valida que sea numerico----      
        else if (!is_numeric(request::getInstance()->getPost(\clienteTableClass::getNameField(\clienteTableClass::TELEFONO, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputTelefono', true);
        session::getInstance()->setError('El telefono no permite letras, solo numeros', 'inputTelefono');
      }
      
      //-------------------------------campo tipo identidad-----------------------------
          //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\clienteTableClass::getNameField(\clienteTableClass::ID_TIPO_ID, true)))) {
        $flag = true;
        session::getInstance()->setFlash('selectTipoId', true);
        session::getInstance()->setError('El tipo de identidad del cliente es requerido', 'selectTipoId');
        }
        
       //-------------------------------campo ciudad-----------------------------
          //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\clienteTableClass::getNameField(\clienteTableClass::ID_CIUDAD, true)))) {
        $flag = true;
        session::getInstance()->setFlash('selectCiudad', true);
        session::getInstance()->setError('La ciudad del cliente es requerido', 'selectCiudad');
        } 

      //-------------------------------condiccion de bandera true-----------------------------
      if ($flag === true) {
        //request::getInstance()->setMethod('GET');
        routing::getInstance()->forward('cliente', 'insertCliente');
      }
    }
  
  
  public static function validateEdit() {
      $flag = false;
//      $soloNumeros = "/^[[:digit:]]+$/";
      $soloLetras = "/^[a-z]+$/i";
      $soloTelefono = "/^(\d{3,3}\-\d{3,3}\-\d{4,4})|^(\+\d\-\d{3,3}\-\d{4,4})/";
      $emailcorrecto = '/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/';
      
      //------------------------------------campo documento---------------------
        //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\clienteTableClass::getNameField(\clienteTableClass::DOCUMENTO, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputDocumento', true);
        session::getInstance()->setError('El documento del cliente es requerido', 'inputDocumento');
      } //----solo numeros----
        
        else if (!is_numeric(request::getInstance()->getPost(\clienteTableClass::getNameField(\clienteTableClass::DOCUMENTO, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputDocumento', true);
        session::getInstance()->setError('El documento no permite letras, solo numeros', 'inputDocumento');
      } //----sobre pasar los caracteres----
        else if(strlen(request::getInstance()->getPost(\clienteTableClass::getNameField(\clienteTableClass::DOCUMENTO, true))) > \clienteTableClass::DOCUMENTO_LENGTH) {
        $flag = true;
        session::getInstance()->setFlash('inputDocumento', true);
        session::getInstance()->setError('El documento digitado es mayor en cantidad de caracteres a lo permitido', 'inputDocumento');
      } //----datos duplicados----
//        else if(self::isUnique(\usuarioTableClass::ID, true, array(\usuarioTableClass::USER => request::getInstance()->getPost('inputUser')), \usuarioTableClass::getNameTable())) {
//        $flag = true;
//        session::getInstance()->setFlash('inputUser', true);
//        session::getInstance()->setError('El usuario digitado ya existe', 'inputUser');
//      }
      
      //-------------------------------campo nombre-----------------------------
          //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\clienteTableClass::getNameField(\clienteTableClass::NOMBRE, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputNombre', true);
        session::getInstance()->setError('El nombre del cliente es requerido', 'inputNombre');
      } //----solo permitir letras----
        else if (!preg_match($soloLetras, (request::getInstance()->getPost(\clienteTableClass::getNameField(\clienteTableClass::NOMBRE, true))))){
        $flag = true;
        session::getInstance()->setFlash('inputNombre', true);
        session::getInstance()->setError('El nombre no permite numeros, solo letras', 'inputNombre');
      } //----sobre pasar los caracteres----
        else if(strlen(request::getInstance()->getPost(\clienteTableClass::getNameField(\clienteTableClass::NOMBRE, true))) > \clienteTableClass::NOMBRE_LENGTH) {
        $flag = true;
        session::getInstance()->setFlash('inputNombre', true);
        session::getInstance()->setError('El nombre digitado es mayor en cantidad de caracteres a lo permitido', 'inputNombre');
      }

   //-------------------------------campo apellido-----------------------------
          //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\clienteTableClass::getNameField(\clienteTableClass::APELLIDO, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputApellido', true);
        session::getInstance()->setError('El apellido del cliente es requerido', 'inputApellido');
      } //----solo permitir letras----
        else if (!preg_match($soloLetras, (request::getInstance()->getPost(\clienteTableClass::getNameField(\clienteTableClass::APELLIDO, true))))){
        $flag = true;
        session::getInstance()->setFlash('inputApellido', true);
        session::getInstance()->setError('El apellido no permite numeros, solo letras', 'inputApellido');
      } //----sobre pasar los caracteres----
        else if(strlen(request::getInstance()->getPost(\clienteTableClass::getNameField(\clienteTableClass::APELLIDO, true))) > \clienteTableClass::APELLIDO_LENGTH) {
        $flag = true;
        session::getInstance()->setFlash('inputApellido', true);
        session::getInstance()->setError('El apellido digitado es mayor en cantidad de caracteres a lo permitido', 'inputApellido');
      }   
      
      
    //-------------------------------campo direccion-----------------------------
          //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\clienteTableClass::getNameField(\clienteTableClass::DIRECCION, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputDireccion', true);
        session::getInstance()->setError('La direccion del cliente es requerido', 'inputDireccion');
        } //----sobre pasar los caracteres----
        else if(strlen(request::getInstance()->getPost(\clienteTableClass::getNameField(\clienteTableClass::DIRECCION, true))) > \clienteTableClass::DIRECCION_LENGTH) {
        $flag = true;
        session::getInstance()->setFlash('inputDireccion', true);
        session::getInstance()->setError('La direccion digitada es mayor en cantidad de caracteres a lo permitido', 'inputDireccion');
      }
      
    //-------------------------------campo telefono-----------------------------
          //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\clienteTableClass::getNameField(\clienteTableClass::TELEFONO, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputTelefono', true);
        session::getInstance()->setError('El telefono del cliente es requerido', 'inputTelefono');
        } //----sobre pasar los caracteres----
        else if(strlen(request::getInstance()->getPost(\clienteTableClass::getNameField(\clienteTableClass::TELEFONO, true))) > \clienteTableClass::TELEFONO_LENGTH) {
        $flag = true;
        session::getInstance()->setFlash('inputTelefono', true);
        session::getInstance()->setError('El telefono digitado es mayor en cantidad de caracteres a lo permitido', 'inputTelefono');
      }  //----valida que sea numerico----      
        else if (!is_numeric(request::getInstance()->getPost(\clienteTableClass::getNameField(\clienteTableClass::TELEFONO, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputTelefono', true);
        session::getInstance()->setError('El telefono no permite letras, solo numeros', 'inputTelefono');
      }
      
      //-------------------------------campo tipo identidad-----------------------------
          //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\clienteTableClass::getNameField(\clienteTableClass::ID_TIPO_ID, true)))) {
        $flag = true;
        session::getInstance()->setFlash('selectTipoId', true);
        session::getInstance()->setError('El tipo de identidad del cliente es requerido', 'selectTipoId');
        }
        
       //-------------------------------campo ciudad-----------------------------
          //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\clienteTableClass::getNameField(\clienteTableClass::ID_CIUDAD, true)))) {
        $flag = true;
        session::getInstance()->setFlash('selectCiudad', true);
        session::getInstance()->setError('La ciudad del cliente es requerido', 'selectCiudad');
        } 

      //-------------------------------condiccion de bandera true-----------------------------
      if ($flag === true) {
        request::getInstance()->setMethod('GET');
        request::getInstance()->addParamGet(array(\clienteTableClass::ID => request::getInstance()->getPost(\clienteTableClass::getNameField(\clienteTableClass::ID, true))));
        routing::getInstance()->forward('cliente', 'editCliente');
      
      }
    }
          
    
   public static function validateFiltroFecha($fechaInicial,$fechaFin) {
      
      if (strtotime($fechaFin) < strtotime($fechaInicial)){
        session::getInstance()->setError('La fecha final no puede ser menor a la actual', 'inputFecha');
          session::getInstance()->setFlash('modalFilters', true);
         
         // echo "<script> alert(' La fecha final no puede ser menor a la actual');</script>'";
      }       
    }
    
     public static function validateFiltro($documento) {
         $soloLetras = "/^[a-z]+$/i";
      $soloTelefono = "/^(\d{3,3}\-\d{3,3}\-\d{4,4})|^(\+\d\-\d{3,3}\-\d{4,4})/";
      $emailcorrecto = '/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/';
      
      if (!is_numeric($documento)) {
           session::getInstance()->setError('El documento no permite letras, solo numeros', 'inputDocumento');
           session::getInstance()->setFlash('modalFilters', true);
           } //----sobre pasar los caracteres----
        else if(strlen($documento) > \clienteTableClass::DOCUMENTO_LENGTH) {
        session::getInstance()->setError('El documento digitado es mayor en cantidad de caracteres a lo permitido', 'inputDocumento');
     session::getInstance()->setFlash('modalFilters', true);
        }
     }
    
    public static function validateFiltroNombre($nombre) {
       $soloLetras = "/^[a-z]+$/i";
      $soloTelefono = "/^(\d{3,3}\-\d{3,3}\-\d{4,4})|^(\+\d\-\d{3,3}\-\d{4,4})/";
      $emailcorrecto = '/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/';
      
      if (!preg_match($soloLetras, ($nombre))){
        session::getInstance()->setError('El nombre no permite numeros, solo letras', 'inputNombre');
     session::getInstance()->setFlash('modalFilters', true);
        } //----sobre pasar los caracteres----
        else if(strlen($nombre) > \clienteTableClass::NOMBRET_LENGTH) {
        session::getInstance()->setError('El nombre digitado es mayor en cantidad de caracteres a lo permitido', 'inputNombre');
      
        session::getInstance()->setFlash('modalFilters', true);
        }  
    }
    
    public static function validateFiltroApellido($apellido) {
  $soloLetras = "/^[a-z]+$/i";
      $soloTelefono = "/^(\d{3,3}\-\d{3,3}\-\d{4,4})|^(\+\d\-\d{3,3}\-\d{4,4})/";
      $emailcorrecto = '/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/';
      
      if (!preg_match($soloLetras, ($apellido))){
        session::getInstance()->setError('El apellido no permite numeros, solo letras', 'inputApellido');
     session::getInstance()->setFlash('modalFilters', true);
        } //----sobre pasar los caracteres----
        else if(strlen($apellido) > \clienteTableClass::APELLIDO_LENGTH) {
   session::getInstance()->setError('El apellido digitado es mayor en cantidad de caracteres a lo permitido', 'inputApellido');
      
   session::getInstance()->setFlash('modalFilters', true);
        }   
       
    }
  }  
}