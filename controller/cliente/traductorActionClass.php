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
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class traductorActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')) {
        
//        echo '<pre>';
//        print_r($_SERVER);
//        echo '</pre>';
//        exit();
        $language = request::getInstance()->getPost('language');
        $PATH_INFO = request::getInstance()->getServer('PATH_INFO');
        session::getInstance()->setDefaultCulture($language);
//        config::setDefaultCulture($language);
        $dir = config::getUrlBase() . config::getIndexFile() . $PATH_INFO;
        header('Location: ' . $dir);
      } else {
        routing::getInstance()->redirect('cliente', 'indexCliente');
      }
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }
  }

}
