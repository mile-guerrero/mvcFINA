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
class deleteActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      
      
      
      
      
      
  
//      if (request::getInstance()->hasPost('filter')) {
//        $filter = request::getInstance()->getPost('filter');
//        //Validar datos
//       
//        if (request::getInstance()->isMethod('POST')) {
//           $documento = $filter['documento'];
//        if (isset($filter['documento']) and $filter['documento'] !== null and $filter['documento'] !== '') {
//          unlink(config::getPathAbsolute() . 'web/uploadArchivo/' . $filter['documento']);
//          session::getInstance()->setSuccess('El Archivo Fue Eliminado Exitosamente');
//        }//cierre del filtro documento
//      
//      }
//      
//        } 

      //------------------------------------------------------------------------
   
       
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }
  }

}
