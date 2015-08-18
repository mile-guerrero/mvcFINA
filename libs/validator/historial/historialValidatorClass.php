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
  class historialValidatorClass extends validatorClass {
    public static function validateInsert() {
      $flag = false;
      //-------------------------------campo tipo insumo-----------------------------
          //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\historialTableClass::getNameField(\historialTableClass::PRODUCTO_INSUMO_ID, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputInsumo', true);
        session::getInstance()->setError('El insumo del historial es requerido', 'inputInsumo');
        }
        
       //-------------------------------campo enfermedad-----------------------------
          //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\historialTableClass::getNameField(\historialTableClass::ENFERMEDAD_ID, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputEnfermedad', true);
        session::getInstance()->setError('La enfermedad del historial es requerido', 'inputEnfermedad');
        } 
      
      if ($flag === true) {
        //request::getInstance()->setMethod('GET');
        routing::getInstance()->forward('historial', 'insert');
      }
    }
  
  
  public static function validateEdit() {
      $flag = false;
//      $soloNumeros = "/^[[:digit:]]+$/";
      $soloLetras = "/^[a-z]+$/i";
      $soloTelefono = "/^(\d{3,3}\-\d{3,3}\-\d{4,4})|^(\+\d\-\d{3,3}\-\d{4,4})/";
      $emailcorrecto = '/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/';
      
      //-------------------------------campo tipo insumo-----------------------------
          //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\historialTableClass::getNameField(\historialTableClass::PRODUCTO_INSUMO_ID, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputInsumo', true);
        session::getInstance()->setError('El insumo del historial es requerido', 'inputInsumo');
        }
        
       //-------------------------------campo enfermedad-----------------------------
          //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\historialTableClass::getNameField(\historialTableClass::ENFERMEDAD_ID, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputEnfermedad', true);
        session::getInstance()->setError('La enfermedad del historial es requerido', 'inputEnfermedad');
        } 

      //-------------------------------condiccion de bandera true-----------------------------
      if ($flag === true) {
        request::getInstance()->setMethod('GET');
        request::getInstance()->addParamGet(array(\historialTableClass::ID => request::getInstance()->getPost(\historialTableClass::getNameField(\historialTableClass::ID, true))));
        routing::getInstance()->forward('historial', 'edit');
      
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
