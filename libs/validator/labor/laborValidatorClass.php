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
  class laborValidatorClass extends validatorClass {
    public static function validateInsert() {
      $flag = false;
//      $soloNumeros = "/^[[:digit:]]+$/";
      $soloLetras = "/^[a-z]+$/i";
      $soloTelefono = "/^(\d{3,3}\-\d{3,3}\-\d{4,4})|^(\+\d\-\d{3,3}\-\d{4,4})/";
      $emailcorrecto = '/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/';
      
      
      
      //-------------------------------campo descripcion-----------------------------
          //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\laborTableClass::getNameField(\laborTableClass::DESCRIPCION, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputDescripcion', true);
        session::getInstance()->setError('La descripcion es requerido', 'inputDescripcion');
      }  //----sobre pasar los caracteres----
        else if(strlen(request::getInstance()->getPost(\laborTableClass::getNameField(\laborTableClass::DESCRIPCION, true))) > \laborTableClass::DESCRIPCION_LENGTH) {
        $flag = true;
        session::getInstance()->setFlash('inputDescripcion', true);
        session::getInstance()->setError('la descripcion digitada es mayor en cantidad de caracteres a lo permitido', 'inputDescripcion');
      }
   
    //-------------------------------campo valor-----------------------------
          //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\laborTableClass::getNameField(\laborTableClass::VALOR, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputValor', true);
        session::getInstance()->setError('El valor de labor es requerido', 'inputValor');
        } //----sobre pasar los caracteres----
        else if(strlen(request::getInstance()->getPost(\laborTableClass::getNameField(\laborTableClass::VALOR, true))) > \laborTableClass::VALOR_LENGTH) {
        $flag = true;
        session::getInstance()->setFlash('inputValor', true);
        session::getInstance()->setError('El valor digitado es mayor en cantidad de caracteres a lo permitido', 'inputValor');
      }  //----valida que sea numerico----      
        else if (!is_numeric(request::getInstance()->getPost(\laborTableClass::getNameField(\laborTableClass::VALOR, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputValor', true);
        session::getInstance()->setError('El documento no permite letras, solo numeros', 'inputValor');
      }
      
      
      //-------------------------------condiccion de bandera true-----------------------------
      if ($flag === true) {
        //request::getInstance()->setMethod('GET');
        routing::getInstance()->forward('labor', 'insert');
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
      if (self::notBlank(request::getInstance()->getPost(\laborTableClass::getNameField(\laborTableClass::DESCRIPCION, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputDescripcion', true);
        session::getInstance()->setError('La descripcion es requerido', 'inputDescripcion');
      } //----sobre pasar los caracteres----
        else if(strlen(request::getInstance()->getPost(\laborTableClass::getNameField(\laborTableClass::DESCRIPCION, true))) > \laborTableClass::DESCRIPCION_LENGTH) {
        $flag = true;
        session::getInstance()->setFlash('inputDescripcion', true);
        session::getInstance()->setError('la descripcion digitada es mayor en cantidad de caracteres a lo permitido', 'inputDescripcion');
      }
   
    //-------------------------------campo valor-----------------------------
          //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\laborTableClass::getNameField(\laborTableClass::VALOR, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputValor', true);
        session::getInstance()->setError('El valor de labor es requerido', 'inputValor');
        } //----sobre pasar los caracteres----
        else if(strlen(request::getInstance()->getPost(\laborTableClass::getNameField(\laborTableClass::VALOR, true))) > \laborTableClass::VALOR_LENGTH) {
        $flag = true;
        session::getInstance()->setFlash('inputValor', true);
        session::getInstance()->setError('El valor digitado es mayor en cantidad de caracteres a lo permitido', 'inputValor');
      }  //----valida que sea numerico----      
        else if (!is_numeric(request::getInstance()->getPost(\laborTableClass::getNameField(\laborTableClass::VALOR, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputValor', true);
        session::getInstance()->setError('El documento no permite letras, solo numeros', 'inputValor');
      }
      //-------------------------------condiccion de bandera true-----------------------------
      if ($flag === true) {
        request::getInstance()->setMethod('GET');
        request::getInstance()->addParamGet(array(\laborTableClass::ID => request::getInstance()->getPost(\laborTableClass::getNameField(\laborTableClass::ID, true))));
        routing::getInstance()->forward('labor', 'edit');
      
      }
    }
  }  
}