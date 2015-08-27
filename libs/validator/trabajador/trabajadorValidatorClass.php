<?php
namespace mvc\validator {
  
  use mvc\validator\validatorClass;
  use mvc\session\sessionClass as session;
  use mvc\request\requestClass as request;
  use mvc\routing\routingClass as routing;
  use mvc\config\myConfigClass as config;
  /**
   * Description of trabajadorValidatorClass
   *
   * @author Gonzalo Andres Bejarano, Elcy Milena Guerrero, Andres Eduardo Bahamon
   */
  class trabajadorValidatorClass extends validatorClass {
    public static function validateInsert() {
      $flag = false;
//      $soloNumeros = "/^[[:digit:]]+$/";
      $soloLetras = "/^[a-z áéíóúÁÉÍÓÚnÑ]+$/i";
      $soloTelefono = "/^(\d{3,3}\-\d{3,3}\-\d{4,4})|^(\+\d\-\d{3,3}\-\d{4,4})/";
      $emailcorrecto = '/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/';
      
      //------------------------------------campo documento---------------------
        //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\trabajadorTableClass::getNameField(\trabajadorTableClass::DOCUMENTO, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputDocumento', true);
        session::getInstance()->setError('El documento del trabajador es requerido', 'inputDocumento');
      } //----solo numeros----
        
        else if (!is_numeric(request::getInstance()->getPost(\trabajadorTableClass::getNameField(\trabajadorTableClass::DOCUMENTO, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputDocumento', true);
        session::getInstance()->setError('El documento no permite letras, solo numeros', 'inputDocumento');
      } //----sobre pasar los caracteres----
        else if(strlen(request::getInstance()->getPost(\trabajadorTableClass::getNameField(\trabajadorTableClass::DOCUMENTO, true))) > \trabajadorTableClass::DOCUMENTO_LENGTH) {
        $flag = true;
        session::getInstance()->setFlash('inputDocumento', true);
        session::getInstance()->setError('El documento digitado es mayor en cantidad de caracteres a lo permitido', 'inputDocumento');
      } //----datos duplicados----
        else if (self::isUnique(\trabajadorTableClass::ID, true, array(\trabajadorTableClass::DOCUMENTO => request::getInstance()->getPost(\trabajadorTableClass::getNameField(\trabajadorTableClass::DOCUMENTO, true))), \trabajadorTableClass::getNameTable())) {
                $flag = true;
                session::getInstance()->setFlash('inputDocumento', true);
                session::getInstance()->setError('El documento digitado ya existe', 'inputDocumento');
            }
      
      //-------------------------------campo nombre-----------------------------
          //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\trabajadorTableClass::getNameField(\trabajadorTableClass::NOMBRET, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputNombre', true);
        session::getInstance()->setError('El nombre del trabajador es requerido', 'inputNombre');
      } //----solo permitir letras----
        else if (!preg_match($soloLetras, (request::getInstance()->getPost(\trabajadorTableClass::getNameField(\trabajadorTableClass::NOMBRET, true))))){
        $flag = true;
        session::getInstance()->setFlash('inputNombre', true);
        session::getInstance()->setError('El nombre no permite numeros, solo letras', 'inputNombre');
      } //----sobre pasar los caracteres----
        else if(strlen(request::getInstance()->getPost(\trabajadorTableClass::getNameField(\trabajadorTableClass::NOMBRET, true))) > \trabajadorTableClass::NOMBRET_LENGTH) {
        $flag = true;
        session::getInstance()->setFlash('inputNombre', true);
        session::getInstance()->setError('El nombre digitado es mayor en cantidad de caracteres a lo permitido', 'inputNombre');
      }

   //-------------------------------campo apellido-----------------------------
          //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\trabajadorTableClass::getNameField(\trabajadorTableClass::APELLIDO, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputApellido', true);
        session::getInstance()->setError('El apellido del trabajador es requerido', 'inputApellido');
      } //----solo permitir letras----
        else if (!preg_match($soloLetras, (request::getInstance()->getPost(\trabajadorTableClass::getNameField(\trabajadorTableClass::APELLIDO, true))))){
        $flag = true;
        session::getInstance()->setFlash('inputApellido', true);
        session::getInstance()->setError('El apellido no permite numeros, solo letras', 'inputApellido');
      } //----sobre pasar los caracteres----
        else if(strlen(request::getInstance()->getPost(\trabajadorTableClass::getNameField(\trabajadorTableClass::APELLIDO, true))) > \trabajadorTableClass::APELLIDO_LENGTH) {
        $flag = true;
        session::getInstance()->setFlash('inputApellido', true);
        session::getInstance()->setError('El apellido digitado es mayor en cantidad de caracteres a lo permitido', 'inputApellido');
      }   
      
      
    //-------------------------------campo direccion-----------------------------
          //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\trabajadorTableClass::getNameField(\trabajadorTableClass::DIRECCION, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputDireccion', true);
        session::getInstance()->setError('La direccion del trabajador es requerido', 'inputDireccion');
        } //----sobre pasar los caracteres----
        else if(strlen(request::getInstance()->getPost(\trabajadorTableClass::getNameField(\trabajadorTableClass::DIRECCION, true))) > \trabajadorTableClass::DIRECCION_LENGTH) {
        $flag = true;
        session::getInstance()->setFlash('inputDireccion', true);
        session::getInstance()->setError('La direccion digitada es mayor en cantidad de caracteres a lo permitido', 'inputDireccion');
      }
      
    //-------------------------------campo telefono-----------------------------
          //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\trabajadorTableClass::getNameField(\trabajadorTableClass::TELEFONO, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputTelefono', true);
        session::getInstance()->setError('El telefono del trabajador es requerido', 'inputTelefono');
        } //----sobre pasar los caracteres----
        else if(strlen(request::getInstance()->getPost(\trabajadorTableClass::getNameField(\trabajadorTableClass::TELEFONO, true))) > \trabajadorTableClass::TELEFONO_LENGTH) {
        $flag = true;
        session::getInstance()->setFlash('inputTelefono', true);
        session::getInstance()->setError('El telefono digitado es mayor en cantidad de caracteres a lo permitido', 'inputTelefono');
      }  //----valida que sea numerico----      
        else if (!is_numeric(request::getInstance()->getPost(\trabajadorTableClass::getNameField(\trabajadorTableClass::TELEFONO, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputTelefono', true);
        session::getInstance()->setError('El documento no permite letras, solo numeros', 'inputTelefono');
      }
      
      //-------------------------------campo tipo identidad-----------------------------
          //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\trabajadorTableClass::getNameField(\trabajadorTableClass::ID_TIPO_ID, true)))) {
        $flag = true;
        session::getInstance()->setFlash('selectTipoId', true);
        session::getInstance()->setError('El tipo de identidad del trabajador es requerido', 'selectTipoId');
        }
        
       //-------------------------------campo ciudad-----------------------------
          //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\trabajadorTableClass::getNameField(\trabajadorTableClass::ID_CIUDAD, true)))) {
        $flag = true;
        session::getInstance()->setFlash('selectCiudad', true);
        session::getInstance()->setError('La ciudad del trabajador es requerido', 'selectCiudad');
        } 
        
         //-------------------------------campo credencial-----------------------------
          //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\trabajadorTableClass::getNameField(\trabajadorTableClass::ID_CREDENCIAL, true)))) {
        $flag = true;
        session::getInstance()->setFlash('selectCredencial', true);
        session::getInstance()->setError('La credencial del trabajador es requerido', 'selectCredencial');
        } 
        
      //-------------------------------campo email-----------------------------
          //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\trabajadorTableClass::getNameField(\trabajadorTableClass::EMAIL, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputEmail', true);
        session::getInstance()->setError('El email del trabajador es requerido', 'inputEmail');
        } //----sobre pasar los caracteres----
        else if(strlen(request::getInstance()->getPost(\trabajadorTableClass::getNameField(\trabajadorTableClass::EMAIL, true))) > \trabajadorTableClass::EMAIL_LENGTH) {
        $flag = true;
        session::getInstance()->setFlash('inputEmail', true);
        session::getInstance()->setError('El email digitado es mayor en cantidad de caracteres a lo permitido', 'inputEmail');
      }  //----solo email----
        else if (!preg_match($emailcorrecto, (request::getInstance()->getPost(\trabajadorTableClass::getNameField(\trabajadorTableClass::EMAIL, true))))){
        $flag = true;
        session::getInstance()->setFlash('inputEmail', true);
        session::getInstance()->setError('Por favor digite un corre válido ', 'inputEmail');
      }   //----datos duplicados----
        else if (self::isUnique(\trabajadorTableClass::ID, true, array(\trabajadorTableClass::EMAIL => request::getInstance()->getPost(\trabajadorTableClass::getNameField(\trabajadorTableClass::EMAIL, true))), \trabajadorTableClass::getNameTable())) {
                $flag = true;
                session::getInstance()->setFlash('inputEmail', true);
                session::getInstance()->setError('El email digitado ya existe', 'inputEmail');
            }
          

      //-------------------------------condiccion de bandera true-----------------------------
      if ($flag === true) {
        //request::getInstance()->setMethod('GET');
        routing::getInstance()->forward('trabajador', 'insert');
      }
    }
    
    public static function validateEdit() {
      $flag = false;
//      $soloNumeros = "/^[[:digit:]]+$/";
      $soloLetras = "/^[a-z áéíóúÁÉÍÓÚnÑ]+$/i";
      $soloTelefono = "/^(\d{3,3}\-\d{3,3}\-\d{4,4})|^(\+\d\-\d{3,3}\-\d{4,4})/";
      $emailcorrecto = '/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/';
      
      //------------------------------------campo documento---------------------
        //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\trabajadorTableClass::getNameField(\trabajadorTableClass::DOCUMENTO, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputDocumento', true);
        session::getInstance()->setError('El documento del trabajador es requerido', 'inputDocumento');
      } //----solo numeros----
        
        else if (!is_numeric(request::getInstance()->getPost(\trabajadorTableClass::getNameField(\trabajadorTableClass::DOCUMENTO, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputDocumento', true);
        session::getInstance()->setError('El documento no permite letras, solo numeros', 'inputDocumento');
      } //----sobre pasar los caracteres----
        else if(strlen(request::getInstance()->getPost(\trabajadorTableClass::getNameField(\trabajadorTableClass::DOCUMENTO, true))) > \trabajadorTableClass::DOCUMENTO_LENGTH) {
        $flag = true;
        session::getInstance()->setFlash('inputDocumento', true);
        session::getInstance()->setError('El documento digitado es mayor en cantidad de caracteres a lo permitido', 'inputDocumento');
      } //----datos duplicados----
//       else if (self::isUnique(\trabajadorTableClass::ID, true, array(\trabajadorTableClass::DOCUMENTO => request::getInstance()->getPost(\trabajadorTableClass::getNameField(\trabajadorTableClass::DOCUMENTO, true))), \trabajadorTableClass::getNameTable())) {
//                $flag = true;
//                session::getInstance()->setFlash('inputDocumento', true);
//                session::getInstance()->setError('El documento digitado ya existe', 'inputDocumento');
//            }
      
      //-------------------------------campo nombre-----------------------------
          //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\trabajadorTableClass::getNameField(\trabajadorTableClass::NOMBRET, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputNombre', true);
        session::getInstance()->setError('El nombre del trabajador es requerido', 'inputNombre');
      } //----solo permitir letras----
        else if (!preg_match($soloLetras, (request::getInstance()->getPost(\trabajadorTableClass::getNameField(\trabajadorTableClass::NOMBRET, true))))){
        $flag = true;
        session::getInstance()->setFlash('inputNombre', true);
        session::getInstance()->setError('El nombre no permite numeros, solo letras', 'inputNombre');
      } //----sobre pasar los caracteres----
        else if(strlen(request::getInstance()->getPost(\trabajadorTableClass::getNameField(\trabajadorTableClass::NOMBRET, true))) > \trabajadorTableClass::NOMBRET_LENGTH) {
        $flag = true;
        session::getInstance()->setFlash('inputNombre', true);
        session::getInstance()->setError('El nombre digitado es mayor en cantidad de caracteres a lo permitido', 'inputNombre');
      }

   //-------------------------------campo apellido-----------------------------
          //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\trabajadorTableClass::getNameField(\trabajadorTableClass::APELLIDO, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputApellido', true);
        session::getInstance()->setError('El apellido del trabajador es requerido', 'inputApellido');
      } //----solo permitir letras----
        else if (!preg_match($soloLetras, (request::getInstance()->getPost(\trabajadorTableClass::getNameField(\trabajadorTableClass::APELLIDO, true))))){
        $flag = true;
        session::getInstance()->setFlash('inputApellido', true);
        session::getInstance()->setError('El apellido no permite numeros, solo letras', 'inputApellido');
      } //----sobre pasar los caracteres----
        else if(strlen(request::getInstance()->getPost(\trabajadorTableClass::getNameField(\trabajadorTableClass::APELLIDO, true))) > \trabajadorTableClass::APELLIDO_LENGTH) {
        $flag = true;
        session::getInstance()->setFlash('inputApellido', true);
        session::getInstance()->setError('El apellido digitado es mayor en cantidad de caracteres a lo permitido', 'inputApellido');
      }   
      
      
    //-------------------------------campo direccion-----------------------------
          //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\trabajadorTableClass::getNameField(\trabajadorTableClass::DIRECCION, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputDireccion', true);
        session::getInstance()->setError('La direccion del trabajador es requerido', 'inputDireccion');
        } //----sobre pasar los caracteres----
        else if(strlen(request::getInstance()->getPost(\trabajadorTableClass::getNameField(\trabajadorTableClass::DIRECCION, true))) > \trabajadorTableClass::DIRECCION_LENGTH) {
        $flag = true;
        session::getInstance()->setFlash('inputDireccion', true);
        session::getInstance()->setError('La direccion digitada es mayor en cantidad de caracteres a lo permitido', 'inputDireccion');
      }
      
    //-------------------------------campo telefono-----------------------------
          //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\trabajadorTableClass::getNameField(\trabajadorTableClass::TELEFONO, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputTelefono', true);
        session::getInstance()->setError('El telefono del trabajador es requerido', 'inputTelefono');
        } //----sobre pasar los caracteres----
        else if(strlen(request::getInstance()->getPost(\trabajadorTableClass::getNameField(\trabajadorTableClass::TELEFONO, true))) > \trabajadorTableClass::TELEFONO_LENGTH) {
        $flag = true;
        session::getInstance()->setFlash('inputTelefono', true);
        session::getInstance()->setError('El telefono digitado es mayor en cantidad de caracteres a lo permitido', 'inputTelefono');
      }  //----valida que sea numerico----      
        else if (!is_numeric(request::getInstance()->getPost(\trabajadorTableClass::getNameField(\trabajadorTableClass::TELEFONO, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputTelefono', true);
        session::getInstance()->setError('El documento no permite letras, solo numeros', 'inputTelefono');
      }
      
      //-------------------------------campo tipo identidad-----------------------------
          //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\trabajadorTableClass::getNameField(\trabajadorTableClass::ID_TIPO_ID, true)))) {
        $flag = true;
        session::getInstance()->setFlash('selectTipoId', true);
        session::getInstance()->setError('El tipo de identidad del trabajador es requerido', 'selectTipoId');
        }
        
       //-------------------------------campo ciudad-----------------------------
          //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\trabajadorTableClass::getNameField(\trabajadorTableClass::ID_CIUDAD, true)))) {
        $flag = true;
        session::getInstance()->setFlash('selectCiudad', true);
        session::getInstance()->setError('La ciudad del trabajador es requerido', 'selectCiudad');
        } 
        
         //-------------------------------campo credencial-----------------------------
          //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\trabajadorTableClass::getNameField(\trabajadorTableClass::ID_CREDENCIAL, true)))) {
        $flag = true;
        session::getInstance()->setFlash('selectCredencial', true);
        session::getInstance()->setError('La credencial del trabajador es requerido', 'selectCredencial');
        } 
        
      //-------------------------------campo email-----------------------------
          //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\trabajadorTableClass::getNameField(\trabajadorTableClass::EMAIL, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputEmail', true);
        session::getInstance()->setError('El email del trabajador es requerido', 'inputEmail');
        } //----sobre pasar los caracteres----
        else if(strlen(request::getInstance()->getPost(\trabajadorTableClass::getNameField(\trabajadorTableClass::EMAIL, true))) > \trabajadorTableClass::EMAIL_LENGTH) {
        $flag = true;
        session::getInstance()->setFlash('inputEmail', true);
        session::getInstance()->setError('El email digitado es mayor en cantidad de caracteres a lo permitido', 'inputEmail');
      }  //----solo email----
        else if (!preg_match($emailcorrecto, (request::getInstance()->getPost(\trabajadorTableClass::getNameField(\trabajadorTableClass::EMAIL, true))))){
        $flag = true;
        session::getInstance()->setFlash('inputEmail', true);
        session::getInstance()->setError('Por favor digite un corre válido ', 'inputEmail');
      }   //----datos duplicados----
//     else if (self::isUnique(\trabajadorTableClass::ID, true, array(\trabajadorTableClass::EMAIL => request::getInstance()->getPost(\trabajadorTableClass::getNameField(\trabajadorTableClass::EMAIL, true))), \trabajadorTableClass::getNameTable())) {
//                $flag = true;
//                session::getInstance()->setFlash('inputEmail', true);
//                session::getInstance()->setError('El email digitado ya existe', 'inputEmail');
//            }   
          

      //-------------------------------condiccion de bandera true-----------------------------
      if ($flag === true) {
        request::getInstance()->setMethod('GET');
        request::getInstance()->addParamGet(array(\trabajadorTableClass::ID => request::getInstance()->getPost(\trabajadorTableClass::getNameField(\trabajadorTableClass::ID, true))));
        routing::getInstance()->forward('trabajador', 'edit');
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
        else if(strlen($documento) > \trabajadorTableClass::DOCUMENTO_LENGTH) {
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
        else if(strlen($nombre) > \trabajadorTableClass::NOMBRET_LENGTH) {
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
        else if(strlen($apellido) > \trabajadorTableClass::APELLIDO_LENGTH) {
   session::getInstance()->setError('El apellido digitado es mayor en cantidad de caracteres a lo permitido', 'inputApellido');
      
   session::getInstance()->setFlash('modalFilters', true);
        }   
       
    }
  }
  
}