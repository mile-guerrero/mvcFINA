<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

/**
 * Description of ejemploClass
 *
 * @author Gonzalo Andres Bejarano, Elcy Milena Guerrero, Andres Eduardo Bahamon
 */
class deleteProveedorActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST') and request::getInstance()->isAjaxRequest()) {

        $id = request::getInstance()->getPost(proveedorTableClass::getNameField(proveedorTableClass::ID, true));
       
        $ids = array(
            proveedorTableClass::ID => $id
        );
       proveedorTableClass::delete($ids, true);
       // routing::getInstance()->redirect('cliente', 'index');
       $this->arrayAjax = array(
           'code' => 200,
           'msg'  => 'La Eliminacion fue Exitosa'
           );
       $this->defineView('deleteProveedor', 'maquina', session::getInstance()->getFormatOutput());
       session::getInstance()->setSuccess('La Eliminacion fue Exitosa');
      } else {
        routing::getInstance()->redirect('maquina', 'indexProveedor');
      }
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }
  }

}

