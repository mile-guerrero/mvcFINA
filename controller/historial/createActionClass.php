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
class createActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')) {

        $insumo = request::getInstance()->getPost(historialTableClass::getNameField(historialTableClass::PRODUCTO_INSUMO_ID, true));
        $enfermedad = request::getInstance()->getPost(historialTableClass::getNameField(historialTableClass::ENFERMEDAD_ID, true));
        $plaga = request::getInstance()->getPost(historialTableClass::getNameField(historialTableClass::PLAGA_ID, true));
        $lote = request::getInstance()->getPost(historialTableClass::getNameField(historialTableClass::LOTE_ID, true));

        validator::validateInsert();

        $data = array(
            historialTableClass::PRODUCTO_INSUMO_ID => $insumo,
            historialTableClass::ENFERMEDAD_ID => $enfermedad,
            historialTableClass::PLAGA_ID => $plaga,
            historialTableClass::LOTE_ID => $lote,
            '__sequence' => 'historial_id_seq'
        );
        $id = historialTableClass::insert($data);
        session::getInstance()->setSuccess('El registro fue exitoso');
        $observacion = 'se ha insertando un nuevo historial';
        log::register('Insertar', historialTableClass::getNameTable(), $observacion, $id);
        routing::getInstance()->redirect('historial', 'index');
      } else {
        routing::getInstance()->redirect('historial', 'index');
      }
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }
  }

}
