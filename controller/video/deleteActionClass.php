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

       
      
      
  if (request::getInstance()->isMethod('POST')and request::getInstance()->isAjaxRequest()) {    

        $id = request::getInstance()->getPost(videoTableClass::getNameField(videoTableClass::ID, true));
        
        $fields = array(
          videoTableClass::ID,
          videoTableClass::HASH,
      );
        $where = array(
            videoTableClass::ID => $id
        );
       $objEliminarVideo = videoTableClass::getAll($fields, false, null, null, null, null, $where);
       
       unlink(config::getPathAbsolute() . 'web/uploadVideo/' . $objEliminarVideo[0]->hash);
        
        $ids = array(
            videoTableClass::ID => $id
        );
       videoTableClass::delete($ids, false);
       
        $this->arrayAjax = array(
            'code'=> 200,
            'msg'=> 'Eliminacion exitosa'
            );
        session::getInstance()->setSuccess('El campo Fue Eliminado Exitosamente');
        
          
        $this->defineView('delete', 'video', session::getInstance()->getFormatOutput());
        
      
      }//cierre del if
       else {
        routing::getInstance()->redirect('video', 'ver');
      }//cierre del else

       
        
      
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }
  }

}
