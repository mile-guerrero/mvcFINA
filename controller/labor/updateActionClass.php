
<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use mvc\validator\cooperativaValidatorClass as validator;


/**
 * Description of ejemploClass
 *
 * @author Gonzalo Andres Bejarano, Elcy Milena Guerrero, Andres Eduardo Bahamon
 */
class updateActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')) {
        $id = request::getInstance()->getPost(laborTableClass::getNameField(laborTableClass::ID, true));
        $descripcion = request::getInstance()->getPost(laborTableClass::getNameField(laborTableClass::DESCRIPCION, true));
        $valor = request::getInstance()->getPost(laborTableClass::getNameField(laborTableClass::VALOR, true));
       
       
        validator::validateEdit(); 
//        $this->validate($descripcion, $valor);
         
     
        $ids = array(
            laborTableClass::ID => $id
        );
        $data = array(
           laborTableClass::DESCRIPCION => $descripcion,
           laborTableClass::VALOR => $valor          
        );
        laborTableClass::update($ids, $data);
         session::getInstance()->setSuccess('La actualizacion fue correcta');
        routing::getInstance()->redirect('labor', 'index');
      }

    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
     
    }
  }
//  public function validate($descripcion, $valor) {
//
//    $flag = false;
//    $soloNumeros = "/^[[:digit:]]+$/";
//    $soloLetras = "/^[a-z]+$/i";
//
////---------------------validacion descripcion----------------------------------------     
//    if (strlen($descripcion) > laborTableClass::DESCRIPCION_LENGTH) {
//      session::getInstance()->setError(i18n::__(00001, null, 'errors', array(':longitud' => laborTableClass::DESCRIPCION_LENGTH)), 00001);
//      $flag = true;
//      }
//
//    if (strlen($descripcion)  == null or $descripcion === "") {
//      session::getInstance()->setError(i18n::__(00009, null, 'errors', array(':campo vacio' => laborTableClass::DESCRIPCION)), 00009);
//      $flag = true;
//     }
//     
//    
//    if (!preg_match($soloLetras, $descripcion)) {
//       session::getInstance()->setError(i18n::__(00012, null, 'errors', array(':no permite letras' => laborTableClass::DESCRIPCION)), 00012);
//       $flag = true;
//       }
//     
//
////-------------------validacion de valor-------------------------------------
//  if (strlen($valor) > laborTableClass::VALOR_LENGTH) {
//      session::getInstance()->setError(i18n::__(00014, null, 'errors', array(':longitud' => laborTableClass::VALOR_LENGTH)), 00014);
//      $flag = true;
//     }
//  if (strlen($valor) == null or $valor === "") {
//      session::getInstance()->setError(i18n::__(00009, null, 'errors', array(':campo vacio' => laborTableClass::VALOR)), 00009);
//      $flag = true;
//     }
// if (!preg_match($soloNumeros, $valor)) {
//      session::getInstance()->setError(i18n::__(00016, null, 'errors', array(':no permite letras' => laborTableClass::VALOR)), 00016);
//      $flag = true;
//       }
// 
////-------------------validacion ------------------------------------------------
//    if ($flag === true){
//    request::getInstance()->setMethod('GET');
//    request::getInstance()->addParamGet(array(laborTableClass::ID => request::getInstance()->getPost(laborTableClass::getNameField(laborTableClass::ID, true))));
//    routing::getInstance()->forward('labor', 'edit');
//  }
//  }
}


