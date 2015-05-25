<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use mvc\validator\manoObraValidatorClass as validator;

/**
 * Description of ejemploClass
 *
 * @author Gonzalo Andres Bejarano, Elcy Milena Guerrero, Andres Eduardo Bahamon
 */
class createActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')) {

        $cantidad = request::getInstance()->getPost(manoObraTableClass::getNameField(manoObraTableClass::CANTIDAD_HORA, true));
        $valor = request::getInstance()->getPost(manoObraTableClass::getNameField(manoObraTableClass::VALOR_HORA, true));
        $cooperativa = request::getInstance()->getPost(manoObraTableClass::getNameField(manoObraTableClass::COOPERATIVA_ID, true));
        $labor = request::getInstance()->getPost(manoObraTableClass::getNameField(manoObraTableClass::LABOR_ID, true));
        $maquina = request::getInstance()->getPost(manoObraTableClass::getNameField(manoObraTableClass::MAQUINA_ID, true));

        //$this->validate($cantidad, $valor);
        validator::validateInsert();

        $data = array(
            manoObraTableClass::CANTIDAD_HORA => $cantidad,
            manoObraTableClass::VALOR_HORA => $valor,
            manoObraTableClass::COOPERATIVA_ID => $cooperativa,
            manoObraTableClass::LABOR_ID => $labor,            
            manoObraTableClass::MAQUINA_ID => $maquina
            
        );
        manoObraTableClass::insert($data);
        session::getInstance()->setSuccess('El registro fue exitoso');
        routing::getInstance()->redirect('manoObra', 'index');
      } else {
        routing::getInstance()->redirect('manoObra', 'index');
      }
    } catch (PDOException $exc) {
      routing::getInstance()->redirect('manoObra', 'insert');
      session::getInstance()->setFlash('exc', $exc);
    }
  }

}






 

        
            
           
        