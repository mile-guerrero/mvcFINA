
<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use mvc\validator\trabajadorValidatorClass as validator;

/**
 * Description of ejemploClass
 *
 * @author 
 */
class updateActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')) {
        $id = request::getInstance()->getPost(trabajadorTableClass::getNameField(trabajadorTableClass::ID, true));
        $documento = request::getInstance()->getPost(trabajadorTableClass::getNameField(trabajadorTableClass::DOCUMENTO, true));
        $nombre = request::getInstance()->getPost(trabajadorTableClass::getNameField(trabajadorTableClass::NOMBRET, true));
        $apellido = request::getInstance()->getPost(trabajadorTableClass::getNameField(trabajadorTableClass::APELLIDO, true));
        $direccion = request::getInstance()->getPost(trabajadorTableClass::getNameField(trabajadorTableClass::DIRECCION, true));
        $telefono = request::getInstance()->getPost(trabajadorTableClass::getNameField(trabajadorTableClass::TELEFONO, true));
        $email = request::getInstance()->getPost(trabajadorTableClass::getNameField(trabajadorTableClass::EMAIL, true));
        $idTipo = request::getInstance()->getPost(trabajadorTableClass::getNameField(trabajadorTableClass::ID_TIPO_ID, true));
        $idCiudad = request::getInstance()->getPost(trabajadorTableClass::getNameField(trabajadorTableClass::ID_CIUDAD, true));
        $idCredencial = request::getInstance()->getPost(trabajadorTableClass::getNameField(trabajadorTableClass::ID_CREDENCIAL, true));
        
         validator::validateEdit();
        
        
        $ids = array(
            trabajadorTableClass::ID => $id
        );
        $data = array(
            trabajadorTableClass::DOCUMENTO => $documento,
            trabajadorTableClass::NOMBRET => $nombre,
            trabajadorTableClass::APELLIDO => $apellido,
            trabajadorTableClass::DIRECCION => $direccion,
            trabajadorTableClass::TELEFONO => $telefono,
            trabajadorTableClass::EMAIL => $email,
            trabajadorTableClass::ID_TIPO_ID => $idTipo,
            trabajadorTableClass::ID_CIUDAD => $idCiudad,
            trabajadorTableClass::ID_CREDENCIAL => $idCredencial
        );
        trabajadorTableClass::update($ids, $data);
        session::getInstance()->setSuccess('La actualizacion fue correcta');
        routing::getInstance()->redirect('trabajador', 'index');
      }

    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
     
    }
  }

     
}
