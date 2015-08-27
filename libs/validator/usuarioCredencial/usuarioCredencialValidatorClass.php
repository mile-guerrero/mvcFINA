<?php
namespace mvc\validator {
  
  use mvc\validator\validatorClass;
  use mvc\session\sessionClass as session;
  use mvc\request\requestClass as request;
  use mvc\routing\routingClass as routing;
  use mvc\config\myConfigClass as config;
  /**
   * Description of usuarioCredencialValidatorClass
   *
   * @author Gonzalo Andres Bejarano, Elcy Milena Guerrero, Andres Eduardo Bahamon
   */
  class usuarioCredencialValidatorClass extends validatorClass {
    
    public static function validateInsert() {
      $flag = false;
      if (self::notBlank(request::getInstance()->getPost(\usuarioCredencialTableClass::getNameField(\usuarioCredencialTableClass::USUARIO_ID, true)))) {
        $flag = true;
        session::getInstance()->setFlash('selectUsuario', true);
        session::getInstance()->setError('El usuario es requerido', 'selectUsuario');
        }else if (self::isUnique(\usuarioCredencialTableClass::USUARIO_ID, false, array(\usuarioCredencialTableClass::USUARIO_ID => request::getInstance()->getPost(\usuarioCredencialTableClass::getNameField(\usuarioCredencialTableClass::USUARIO_ID, true))), \usuarioCredencialTableClass::getNameTable())) {
                $flag = true;
                session::getInstance()->setFlash('selectUsuario', true);
                session::getInstance()->setError('El usuario ya esta siendo utilizada', 'selectUsuario');
            }
        else if (self::notBlank(request::getInstance()->getPost(\usuarioCredencialTableClass::getNameField(\usuarioCredencialTableClass::CREDENCIAL_ID, true)))) {
        $flag = true;
        session::getInstance()->setFlash('selectCredencial', true);
        session::getInstance()->setError('La credencial es requerida', 'selectCredencial');
        }
        else if (self::isUnique(\usuarioCredencialTableClass::CREDENCIAL_ID, false, array(\usuarioCredencialTableClass::CREDENCIAL_ID => request::getInstance()->getPost(\usuarioCredencialTableClass::getNameField(\usuarioCredencialTableClass::CREDENCIAL_ID, true))), \usuarioCredencialTableClass::getNameTable())) {
                $flag = true;
                session::getInstance()->setFlash('selectCredencial', true);
                session::getInstance()->setError('El credencial ya esta siendo utilizada', 'selectCredencial');
            }
      
     if ($flag === true) {
        //request::getInstance()->setMethod('GET');
        routing::getInstance()->forward('usuarioCredencial', 'insert');
      }
    }
    public static function validateEdit() {
       
       $flag = false;
      if (self::notBlank(request::getInstance()->getPost(\usuarioCredencialTableClass::getNameField(\usuarioCredencialTableClass::USUARIO_ID, true)))) {
        $flag = true;
        session::getInstance()->setFlash('selectUsuario', true);
        session::getInstance()->setError('El usuario es requerido', 'selectUsuario');
        }else if (self::isUnique(\usuarioCredencialTableClass::USUARIO_ID, false, array(\usuarioCredencialTableClass::USUARIO_ID => request::getInstance()->getPost(\usuarioCredencialTableClass::getNameField(\usuarioCredencialTableClass::USUARIO_ID, true))), \usuarioCredencialTableClass::getNameTable())) {
                $flag = true;
                session::getInstance()->setFlash('selectUsuario', true);
                session::getInstance()->setError('El usuario ya esta siendo utilizada', 'selectUsuario');
            }
        else if (self::notBlank(request::getInstance()->getPost(\usuarioCredencialTableClass::getNameField(\usuarioCredencialTableClass::CREDENCIAL_ID, true)))) {
        $flag = true;
        session::getInstance()->setFlash('selectCredencial', true);
        session::getInstance()->setError('La credencial es requerida', 'selectCredencial');
        }
        else if (self::isUnique(\usuarioCredencialTableClass::CREDENCIAL_ID, false, array(\usuarioCredencialTableClass::CREDENCIAL_ID => request::getInstance()->getPost(\usuarioCredencialTableClass::getNameField(\usuarioCredencialTableClass::CREDENCIAL_ID, true))), \usuarioCredencialTableClass::getNameTable())) {
                $flag = true;
                session::getInstance()->setFlash('selectCredencial', true);
                session::getInstance()->setError('El credencial ya esta siendo utilizada', 'selectCredencial');
            }
       if ($flag === true) {
        request::getInstance()->setMethod('GET');
        request::getInstance()->addParamGet(array(\usuarioCredencialTableClass::ID => request::getInstance()->getPost(\usuarioCredencialTableClass::getNameField(\usuarioCredencialTableClass::ID, true))));
        routing::getInstance()->forward('usuarioCredencial', 'edit');
      
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