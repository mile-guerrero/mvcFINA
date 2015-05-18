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

public function validate($cantidad, $valor) {

    $flag = false;
    $patron = "/^[[:digit:]]+$/";
//---------------------validacion descripcion----------------------------------- 
    
    if (strlen($cantidad) > manoObraTableClass::CANTIDAD_HORA_LENGTH) {
      session::getInstance()->setError(i18n::__(00004, null, 'errors', array(':longitud' => manoObraTableClass::CANTIDAD_HORA_LENGTH)), 00004);
      $flag = true;
    } 
    
    if (!is_numeric($cantidad) == "" ) {
      session::getInstance()->setError(i18n::__(00009, null, 'errors', array(':campo vacio' => manoObraTableClass::CANTIDAD_HORA)), 00009);
      $flag = true;
    }
    
    if (!preg_match($patron, $cantidad)) {
      session::getInstance()->setError(i18n::__(00010, null, 'errors', array(':numeros' => $cantidad)), 00010);
      $flag = true;
       }

    
//-----------------------validacion iva-----------------------------------------    
//     if (!is_numeric($valor) == "" ) {
//      session::getInstance()->setError(i18n::__(00009, null, 'errors', array(':campo vacio' => manoObraTableClass::VALOR_HORA)), 00009);
//      $flag = true;
//    }
    
    if (strlen($valor) > manoObraTableClass::VALOR_HORA_LENGTH) {
      session::getInstance()->setError(i18n::__(00014, null, 'errors', array(':longitud' => manoObraTableClass::VALOR_HORA_LENGTH)), 00014);
      $flag = true;
    } 

    if (!preg_match($patron, $valor)) {
      session::getInstance()->setError(i18n::__(00010, null, 'errors', array(':numeros' => $valor)), 00010);
      $flag = true;
       }
//-----------------------validacion --------------------------------------------    
    if ($flag === true){
      request::getInstance()->setMethod('GET');
      routing::getInstance()->forward('manoObra', 'insert');
    }
  }

}






 

        
            
           
        