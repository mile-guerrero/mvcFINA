
<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use mvc\validator\historialValidatorClass as validator;
use hook\log\logHookClass as log;

/**
 * Description of ejemploClass
 *
 * @author Gonzalo Andres Bejarano, Elcy Milena Guerrero, Andres Eduardo Bahamon
 */
class updateActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')) {
        $id = request::getInstance()->getPost(historialTableClass::getNameField(historialTableClass::ID, true));
        $insumo = request::getInstance()->getPost(historialTableClass::getNameField(historialTableClass::PRODUCTO_INSUMO_ID, true));
        $enfermedad = request::getInstance()->getPost(historialTableClass::getNameField(historialTableClass::ENFERMEDAD_ID, true));

        
        validator::validateEdit();
        $ids = array(
            historialTableClass::ID => $id
        );
        $data = array(
            historialTableClass::PRODUCTO_INSUMO_ID => $insumo,
            historialTableClass::ENFERMEDAD_ID => $enfermedad
        );
        historialTableClass::update($ids, $data);
         session::getInstance()->setSuccess('La actualizacion fue correcta');
         $observacion ='se ha modificado el historial';
        log::register('Modificar', historialTableClass::getNameTable(),$observacion,$id);
        routing::getInstance()->redirect('historial', 'index');
      }
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }
  }

}
