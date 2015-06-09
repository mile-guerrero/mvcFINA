<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

/**
* @author Gonzalo Andres Bejarano, Elcy Milena Guerrero, Andres Eduardo Bahamon 
* @date: fecha de inicio del desarrollo.
* @category: modulo de cliente.
*/
class traductorActionClass extends controllerClass implements controllerActionInterface {

  
  /**
* @author: Gonzalo Andres Bejarano, Elcy Milena Guerrero, Andres Eduardo Bahamon .
* @date: fecha de inicio del desarrollo.
* @return   este metodo se calcula para controlar el cambio de idioma en el sistema para ello se 
   * declaran las siguientes variables 
   * $language  es la cultura que esta por defecto $es $en 
   * $PATH_INFO 
   * $QUERY_STRING 
   * $dir  es donde se arma la direcion del traductor
*/
  public function execute() {
    try {
      //if (request::getInstance()->isMethod('POST')) {
        
//        echo '<pre>';
//        print_r($_SERVER);
//        echo '</pre>';
//        exit();
        $language = request::getInstance()->getGet('language');
        $PATH_INFO = request::getInstance()->getGet('PATH_INFO');
        
        if (request::getInstance()->hasGet('QUERY_STRING')) {
          $QUERY_STRING = html_entity_decode(request::getInstance()->getGet('QUERY_STRING'));
        }//cierre del if
        
        session::getInstance()->setDefaultCulture($language);
//        config::setDefaultCulture($language);
        $dir = config::getUrlBase() . config::getIndexFile() . $PATH_INFO;
        $dir .= (isset($QUERY_STRING)) ? '?' . $QUERY_STRING : '';
        header('Location: ' . $dir);
      //} else {
        //routing::getInstance()->redirect('default', 'index');
      //}
    } //cierre del try
      catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }//cierre del catch
  }//cierre de la funcion execute

}//cierre de la clase
