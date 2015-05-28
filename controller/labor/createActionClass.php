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
class createActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')===true) {

        $des = trim(request::getInstance()->getPost(laborTableClass::getNameField(laborTableClass::DESCRIPCION, true)));
        $valor = request::getInstance()->getPost(laborTableClass::getNameField(laborTableClass::VALOR, true));
        
       validator::validateInsert();
//        $this->validate($des,$valor);
        
        $data = array(
            laborTableClass::DESCRIPCION => $des,
            laborTableClass::VALOR => $valor,
        );
        laborBaseTableClass::insert($data);
        session::getInstance()->setSuccess('El registro fue exitoso');
        routing::getInstance()->redirect('labor', 'index');
      } else {
        routing::getInstance()->redirect('labor', 'index');
      }
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }
  }
//private function validate ($des,$valor){
//  $flag = false;
//    $soloNumeros = "/^[[:digit:]]+$/";
//    $soloLetras = "/^[a-z]+$/i";
//    $soloTelefono = "/[0-9](9)$/";
//    
//    //---------------------validacion descripcion-------------------------------------
//  if (strlen($des) > laborTableClass::DESCRIPCION_LENGTH) {
//         session::getInstance()->setError(i18n::__(00007, null, 'errors', array(':longitud' => laborTableClass::DESCRIPCION_LENGTH)), 00007);
//         $flag = true;
//         session::getInstance()->setFlash(laborTableClass::getNameField(laborTableClass::DESCRIPCION, true),true);
//         }
// if (strlen($des)  == null or $des === "") {
//      session::getInstance()->setError(i18n::__(00009, null, 'errors', array(':campo vacio' => laborTableClass::DESCRIPCION)), 00009);
//      $flag = true;
//     }
// if (!preg_match($soloLetras, $des)) {
//       session::getInstance()->setError(i18n::__(00012, null, 'errors', array(':no permite letras' => laborTableClass::DESCRIPCION)), 00012);
//       $flag = true;
//       }
//        
//     //---------------------validacion valors-------------------------------------
//  if (strlen($valor) > laborTableClass::VALOR_LENGTH) {
//      session::getInstance()->setError(i18n::__(00019, null, 'errors', array(':longitud' => laborTableClass::VALOR_LENGTH)), 00019);
//      $flag = true;
//     }
//  if (strlen($valor) == null or $valor === "") {
//      session::getInstance()->setError(i18n::__(00009, null, 'errors', array(':campo vacio' =>laborTableClass::VALOR)), 00009);
//      $flag = true;
//     }
// if (!preg_match($soloNumeros, $valor)) {
//      session::getInstance()->setError(i18n::__(00016, null, 'errors', array(':no permite letras' => laborTableClass::VALOR)), 00016);
//      $flag = true;
//       }
//          
//  if ($flag === true){
//    request::getInstance()->setMethod('GET');
//    routing::getInstance()->forward('labor', 'insert');
//  }
//        
//}
}
