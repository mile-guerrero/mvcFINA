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
 * @author Andres Eduardo Bahamon, Elcy Milena Guerrero, Gonzalo Andres Bejarano
 */
class deleteActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')and request::getInstance()->isAjaxRequest()) {

        $id = request::getInstance()->getPost(pedidoTableClass::getNameField(pedidoTableClass::ID, true));
       
        $ids = array(
            pedidoTableClass::ID => $id
        );
        pedidoTableClass::delete($ids, true);
       $this->arrayAjax = array(
            'code'=> 200,
            'msg'=> 'Eliminacion exitosa'
            );
        $this->defineView('delete', 'pedido', session::getInstance()->getFormatOutput());
      
      } else {
        routing::getInstance()->redirect('pedido', 'index');
      }
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }
  }

}

