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

        $nombre = trim(request::getInstance()->getPost(empresaTableClass::getNameField(empresaTableClass::NOMBRE, true)));
        $direccion = request::getInstance()->getPost(empresaTableClass::getNameField(empresaTableClass::DIRECCION, true));
        $telefono = request::getInstance()->getPost(empresaTableClass::getNameField(empresaTableClass::TELEFONO, true));
        $email = request::getInstance()->getPost(empresaTableClass::getNameField(empresaTableClass::EMAIL, true));
       
        validator::validateInsert();
//        $this->validate($nombre,$direccion,$telefono,$email);
        
        $data = array(
            empresaTableClass::NOMBRE => $nombre,
            empresaTableClass::DIRECCION => $direccion,
            empresaTableClass::TELEFONO => $telefono,
            empresaTableClass::EMAIL=> $email,
        );
       empresaBaseTableClass::insert($data);
        session::getInstance()->setSuccess('El registro fue exitoso');
        routing::getInstance()->redirect('empresa', 'index');
      } else {
        routing::getInstance()->redirect('empresa', 'index');
      }
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }
  }
//private function validate ($nombre,$direccion,$telefono,$email){
//  $flag = false;
//    $soloNumeros = "/^[[:digit:]]+$/";
//    $soloLetras = "/^[a-z]+$/i";
//    $soloTelefono = "/[0-9](9)$/";
//    $emailcorrecto = '/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/';
//    
//    //---------------------validacion nombre-------------------------------------
//  if (strlen($nombre) > empresaTableClass::NOMBRE_LENGTH) {
//         session::getInstance()->setError(i18n::__(00007, null, 'errors', array(':longitud' => empresaTableClass::NOMBRE_LENGTH)), 00007);
//         $flag = true;
//         session::getInstance()->setFlash(empresaTableClass::getNameField(empresaTableClass::NOMBRE, true),true);
//         }
// if (strlen($nombre)  == null or $nombre === "") {
//      session::getInstance()->setError(i18n::__(00009, null, 'errors', array(':campo vacio' => empresaTableClass::NOMBRE)), 00009);
//      $flag = true;
//     }
// if (!preg_match($soloLetras, $nombre)) {
//       session::getInstance()->setError(i18n::__(00012, null, 'errors', array(':no permite letras' => empresaTableClass::NOMBRE)), 00012);
//       $flag = true;
//       }
//     
// //---------------------validacion direccion-------------------------------------
//     if (strlen($direccion) > empresaTableClass::DIRECCION_LENGTH) {
//      session::getInstance()->setError(i18n::__(00002, null, 'errors', array(':longitud' =>empresaTableClass::DIRECCION_LENGTH)), 00002);
//      $flag = true;
//     }
//     
//     if (strlen($direccion)  == null or $direccion === "") {
//      session::getInstance()->setError(i18n::__(00009, null, 'errors', array(':campo vacio' => empresaTableClass::DIRECCION)), 00009);
//      $flag = true;
//     }
//  
//     
//     //---------------------validacion telefono-------------------------------------
//  if (strlen($telefono) > empresaTableClass::TELEFONO_LENGTH) {
//      session::getInstance()->setError(i18n::__(00019, null, 'errors', array(':longitud' => empresaTableClass::TELEFONO_LENGTH)), 00019);
//      $flag = true;
//     }
//  if (strlen($telefono) == null or $telefono === "") {
//      session::getInstance()->setError(i18n::__(00009, null, 'errors', array(':campo vacio' =>empresaTableClass::TELEFONO)), 00009);
//      $flag = true;
//     }
// if (!preg_match($soloNumeros, $telefono)) {
//      session::getInstance()->setError(i18n::__(00016, null, 'errors', array(':no permite letras' => empresaTableClass::TELEFONO)), 00016);
//      $flag = true;
//       }
//       
// //-------------------validacion email------------------------------------------ 
//       
// if (strlen($email) > empresaTableClass::EMAIL_LENGTH) {
//      session::getInstance()->setError(i18n::__(00014, null, 'errors', array(':longitud' => empresaTableClass::EMAIL_LENGTH)), 00014);
//      $flag = true;
//     }
//  if (strlen($email) == null or $email === "") {
//      session::getInstance()->setError(i18n::__(00009, null, 'errors', array(':campo vacio' => empresaTableClass::EMAIL)), 00009);
//      $flag = true;
//     }      
// if (!preg_match($emailcorrecto, $email)) {
//        session::getInstance()->setError(i18n::__(00011, null, 'errors', array(':correo' => $email), 00011));
//        $flag = true; 
//    }
//     
//     
//  if ($flag === true){
//    request::getInstance()->setMethod('GET');
//    routing::getInstance()->forward('empresa', 'insert');
//  }
//        
//}
}
