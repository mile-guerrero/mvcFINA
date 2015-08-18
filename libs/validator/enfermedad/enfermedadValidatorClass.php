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
  class enfermedadValidatorClass extends validatorClass {
    public static function validateInsert() {
      $flag = false;
//      $soloNumeros = "/^[[:digit:]]+$/";
      $soloLetras = "/^[a-z]+$/i";
      $soloTelefono = "/^(\d{3,3}\-\d{3,3}\-\d{4,4})|^(\+\d\-\d{3,3}\-\d{4,4})/";
      $emailcorrecto = '/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/';
          
      //-------------------------------campo nombre-----------------------------
          //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\enfermedadTableClass::getNameField(\enfermedadTableClass::NOMBRE, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputNombre', true);
        session::getInstance()->setError('El nombre de la enfermedad es requerido', 'inputNombre');
      } //----solo permitir letras----
        else if (!preg_match($soloLetras, (request::getInstance()->getPost(\enfermedadTableClass::getNameField(\enfermedadTableClass::NOMBRE, true))))){
        $flag = true;
        session::getInstance()->setFlash('inputNombre', true);
        session::getInstance()->setError('El nombre no permite numeros, solo letras', 'inputNombre');
      } //----sobre pasar los caracteres----
        else if(strlen(request::getInstance()->getPost(\enfermedadTableClass::getNameField(\enfermedadTableClass::NOMBRE, true))) > \enfermedadTableClass::NOMBRE_LENGTH) {
        $flag = true;
        session::getInstance()->setFlash('inputNombre', true);
        session::getInstance()->setError('El nombre digitado es mayor en cantidad de caracteres a lo permitido', 'inputNombre');
      }
      //-------------------------------campo descripcion-----------------------------
          //----campo nulo----
        if (self::notBlank(request::getInstance()->getPost(\enfermedadTableClass::getNameField(\enfermedadTableClass::DESCRIPCION, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputDescripcion', true);
        session::getInstance()->setError('La descripcion de la enfermedad es requerido', 'inputDescripcion');
       }
//       //----solo permitir letras----
//        else if (!preg_match($soloLetras, (request::getInstance()->getPost(\enfermedadTableClass::getNameField(\enfermedadTableClass::DESCRIPCION, true))))){
//        $flag = true;
//        session::getInstance()->setFlash('inputDescripcion', true);
//        session::getInstance()->setError('La descripcion no permite numeros, solo letras', 'inputDescripcion');
//      } //----sobre pasar los caracteres----
        else if(strlen(request::getInstance()->getPost(\enfermedadTableClass::getNameField(\enfermedadTableClass::DESCRIPCION, true))) > \enfermedadTableClass::DESCRIPCION_LENGTH) {
        $flag = true;
        session::getInstance()->setFlash('inputDescripcion', true);
        session::getInstance()->setError('La descripcion digitada es mayor en cantidad de caracteres a lo permitido', 'inputDescripcion');
      }
      //-------------------------------campo tratamiento-----------------------------
          //----campo nulo----
        if (self::notBlank(request::getInstance()->getPost(\enfermedadTableClass::getNameField(\enfermedadTableClass::TRATAMIENTO, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputTratamiento', true);
        session::getInstance()->setError('El tratamiento de la enfermedad es requerido', 'inputTratamiento');
       }
//       //----solo permitir letras----
//        else if (!preg_match($soloLetras, (request::getInstance()->getPost(\enfermedadTableClass::getNameField(\enfermedadTableClass::DESCRIPCION, true))))){
//        $flag = true;
//        session::getInstance()->setFlash('inputDescripcion', true);
//        session::getInstance()->setError('La descripcion no permite numeros, solo letras', 'inputDescripcion');
//      } //----sobre pasar los caracteres----
        else if(strlen(request::getInstance()->getPost(\enfermedadTableClass::getNameField(\enfermedadTableClass::TRATAMIENTO, true))) > \enfermedadTableClass::TRATAMIENTO_LENGTH) {
        $flag = true;
        session::getInstance()->setFlash('inputTratamiento', true);
        session::getInstance()->setError('El tratamiento digitada es mayor en cantidad de caracteres a lo permitido', 'inputTratamiento');
      }
      //-------------------------------condiccion de bandera true-----------------------------
      if ($flag === true) {
        //request::getInstance()->setMethod('GET');
        routing::getInstance()->forward('enfermedad', 'insert');
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
      if (self::notBlank(request::getInstance()->getPost(\enfermedadTableClass::getNameField(\enfermedadTableClass::NOMBRE, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputNombre', true);
        session::getInstance()->setError('El nombre de la enfermedad es requerido', 'inputNombre');
      } //----solo permitir letras----
        else if (!preg_match($soloLetras, (request::getInstance()->getPost(\enfermedadTableClass::getNameField(\enfermedadTableClass::NOMBRE, true))))){
        $flag = true;
        session::getInstance()->setFlash('inputNombre', true);
        session::getInstance()->setError('El nombre no permite numeros, solo letras', 'inputNombre');
      } //----sobre pasar los caracteres----
        else if(strlen(request::getInstance()->getPost(\enfermedadTableClass::getNameField(\enfermedadTableClass::NOMBRE, true))) > \enfermedadTableClass::NOMBRE_LENGTH) {
        $flag = true;
        session::getInstance()->setFlash('inputNombre', true);
        session::getInstance()->setError('El nombre digitado es mayor en cantidad de caracteres a lo permitido', 'inputNombre');
      }
      //-------------------------------campo descripcion-----------------------------
          //----campo nulo----
        if (self::notBlank(request::getInstance()->getPost(\enfermedadTableClass::getNameField(\enfermedadTableClass::DESCRIPCION, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputDescripcion', true);
        session::getInstance()->setError('La descripcion de la enfermedad es requerido', 'inputDescripcion');
       }
//       //----solo permitir letras----
//        else if (!preg_match($soloLetras, (request::getInstance()->getPost(\enfermedadTableClass::getNameField(\enfermedadTableClass::DESCRIPCION, true))))){
//        $flag = true;
//        session::getInstance()->setFlash('inputDescripcion', true);
//        session::getInstance()->setError('La descripcion no permite numeros, solo letras', 'inputDescripcion');
//      } //----sobre pasar los caracteres----
        else if(strlen(request::getInstance()->getPost(\enfermedadTableClass::getNameField(\enfermedadTableClass::DESCRIPCION, true))) > \enfermedadTableClass::DESCRIPCION_LENGTH) {
        $flag = true;
        session::getInstance()->setFlash('inputDescripcion', true);
        session::getInstance()->setError('La descripcion digitada es mayor en cantidad de caracteres a lo permitido', 'inputDescripcion');
      }
      //-------------------------------campo tratamiento-----------------------------
          //----campo nulo----
        if (self::notBlank(request::getInstance()->getPost(\enfermedadTableClass::getNameField(\enfermedadTableClass::TRATAMIENTO, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputTratamiento', true);
        session::getInstance()->setError('El tratamiento de la enfermedad es requerido', 'inputTratamiento');
       }
//       //----solo permitir letras----
//        else if (!preg_match($soloLetras, (request::getInstance()->getPost(\enfermedadTableClass::getNameField(\enfermedadTableClass::DESCRIPCION, true))))){
//        $flag = true;
//        session::getInstance()->setFlash('inputDescripcion', true);
//        session::getInstance()->setError('La descripcion no permite numeros, solo letras', 'inputDescripcion');
//      } //----sobre pasar los caracteres----
        else if(strlen(request::getInstance()->getPost(\enfermedadTableClass::getNameField(\enfermedadTableClass::TRATAMIENTO, true))) > \enfermedadTableClass::TRATAMIENTO_LENGTH) {
        $flag = true;
        session::getInstance()->setFlash('inputTratamiento', true);
        session::getInstance()->setError('El tratamiento digitada es mayor en cantidad de caracteres a lo permitido', 'inputTratamiento');
      }
     
      //-------------------------------condiccion de bandera true-----------------------------
      if ($flag === true) {
        request::getInstance()->setMethod('GET');
        request::getInstance()->addParamGet(array(\enfermedadTableClass::ID => request::getInstance()->getPost(\enfermedadTableClass::getNameField(\enfermedadTableClass::ID, true))));
        routing::getInstance()->forward('enfermedad', 'edit');
      
      }
    }
    
    public static function validateFiltros($documento) {
      $flag = false;
//      $soloNumeros = "/^[[:digit:]]+$/";
      $soloLetras = "/^[a-z]+$/i";
      $soloTelefono = "/^(\d{3,3}\-\d{3,3}\-\d{4,4})|^(\+\d\-\d{3,3}\-\d{4,4})/";
      $emailcorrecto = '/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/';
      
          //-------------------------------campo nombre-----------------------------
          //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\enfermedadTableClass::getNameField(\enfermedadTableClass::NOMBRE, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputNombre', true);
        session::getInstance()->setError('El nombre de la enfermedad es requerido', 'inputNombre');
      } //----solo permitir letras----
        else if (!preg_match($soloLetras, (request::getInstance()->getPost(\enfermedadTableClass::getNameField(\enfermedadTableClass::NOMBRE, true))))){
        $flag = true;
        session::getInstance()->setFlash('inputNombre', true);
        session::getInstance()->setError('El nombre no permite numeros, solo letras', 'inputNombre');
      } //----sobre pasar los caracteres----
        else if(strlen(request::getInstance()->getPost(\enfermedadTableClass::getNameField(\enfermedadTableClass::NOMBRE, true))) > \enfermedadTableClass::NOMBRE_LENGTH) {
        $flag = true;
        session::getInstance()->setFlash('inputNombre', true);
        session::getInstance()->setError('El nombre digitado es mayor en cantidad de caracteres a lo permitido', 'inputNombre');
      }
      //-------------------------------campo descripcion-----------------------------
          //----campo nulo----
        if (self::notBlank(request::getInstance()->getPost(\enfermedadTableClass::getNameField(\enfermedadTableClass::DESCRIPCION, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputDescripcion', true);
        session::getInstance()->setError('La descripcion de la enfermedad es requerido', 'inputDescripcion');
       }
//       //----solo permitir letras----
//        else if (!preg_match($soloLetras, (request::getInstance()->getPost(\enfermedadTableClass::getNameField(\enfermedadTableClass::DESCRIPCION, true))))){
//        $flag = true;
//        session::getInstance()->setFlash('inputDescripcion', true);
//        session::getInstance()->setError('La descripcion no permite numeros, solo letras', 'inputDescripcion');
//      } //----sobre pasar los caracteres----
        else if(strlen(request::getInstance()->getPost(\enfermedadTableClass::getNameField(\enfermedadTableClass::DESCRIPCION, true))) > \enfermedadTableClass::DESCRIPCION_LENGTH) {
        $flag = true;
        session::getInstance()->setFlash('inputDescripcion', true);
        session::getInstance()->setError('La descripcion digitada es mayor en cantidad de caracteres a lo permitido', 'inputDescripcion');
      }
      //-------------------------------campo tratamiento-----------------------------
          //----campo nulo----
        if (self::notBlank(request::getInstance()->getPost(\enfermedadTableClass::getNameField(\enfermedadTableClass::TRATAMIENTO, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputTratamiento', true);
        session::getInstance()->setError('El tratamiento de la enfermedad es requerido', 'inputTratamiento');
       }
//       //----solo permitir letras----
//        else if (!preg_match($soloLetras, (request::getInstance()->getPost(\enfermedadTableClass::getNameField(\enfermedadTableClass::DESCRIPCION, true))))){
//        $flag = true;
//        session::getInstance()->setFlash('inputDescripcion', true);
//        session::getInstance()->setError('La descripcion no permite numeros, solo letras', 'inputDescripcion');
//      } //----sobre pasar los caracteres----
        else if(strlen(request::getInstance()->getPost(\enfermedadTableClass::getNameField(\enfermedadTableClass::TRATAMIENTO, true))) > \enfermedadTableClass::TRATAMIENTO_LENGTH) {
        $flag = true;
        session::getInstance()->setFlash('inputTratamiento', true);
        session::getInstance()->setError('El tratamiento digitada es mayor en cantidad de caracteres a lo permitido', 'inputTratamiento');
      }
      

      //-------------------------------condiccion de bandera true-----------------------------
      if ($flag === true) {
        //request::getInstance()->setMethod('GET');
        routing::getInstance()->forward('enfermedad', 'index');
      }
    }
    public static function validateFiltroFecha($fechaInicial,$fechaFin) {
      
      if (strtotime($fechaFin) < strtotime($fechaInicial)){
        session::getInstance()->setError('La fecha final no puede ser menor a la actual', 'inputFecha');
          session::getInstance()->setFlash('modalFilters', true);
         
         // echo "<script> alert(' La fecha final no puede ser menor a la actual');</script>'";
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
        else if(strlen($nombre) > \enfermedadTableClass::NOMBRE_LENGTH) {
        session::getInstance()->setError('El nombre digitado es mayor en cantidad de caracteres a lo permitido', 'inputNombre');
      
        session::getInstance()->setFlash('modalFilters', true);
        }  
    }
  }  
}