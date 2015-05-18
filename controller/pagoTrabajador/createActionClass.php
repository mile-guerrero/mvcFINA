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
 * @author Andres Bahamon
 */
class createActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')) {
        
        $fecha_ini = request::getInstance()->getPost(pagoTrabajadorTableClass::getNameField(pagoTrabajadorTableClass::FECHA_INICIAL, true));
        $fecha_fin = request::getInstance()->getPost(pagoTrabajadorTableClass::getNameField(pagoTrabajadorTableClass::FECHA_FINAL, true));
        $idEmpresa = request::getInstance()->getPost(pagoTrabajadorTableClass::getNameField(pagoTrabajadorTableClass::EMPRESA_ID, true));
        $idTrabajador = request::getInstance()->getPost(pagoTrabajadorTableClass::getNameField(pagoTrabajadorTableClass::TRABAJADOR_ID, true));
        $valor = request::getInstance()->getPost(pagoTrabajadorTableClass::getNameField(pagoTrabajadorTableClass::VALOR_SALARIO, true));
        $cantidad = request::getInstance()->getPost(pagoTrabajadorTableClass::getNameField(pagoTrabajadorTableClass::CANTIDAD_HORAS_EXTRAS, true));
        $valorHoras = request::getInstance()->getPost(pagoTrabajadorTableClass::getNameField(pagoTrabajadorTableClass::VALOR_HORAS_EXTRAS, true));
        $horas = request::getInstance()->getPost(pagoTrabajadorTableClass::getNameField(pagoTrabajadorTableClass::HORAS_PERDIDAS, true));
        $total = request::getInstance()->getPost(pagoTrabajadorTableClass::getNameField(pagoTrabajadorTableClass::TOTAL_PAGAR, true));

        $this->validate($valor, $cantidad, $valorHoras, $horas, $total);

        $data = array(
          pagoTrabajadorTableClass::FECHA_INICIAL => $fecha_ini,
          pagoTrabajadorTableClass::FECHA_FINAL => $fecha_fin,
          pagoTrabajadorTableClass::EMPRESA_ID => $idEmpresa,
          pagoTrabajadorTableClass::TRABAJADOR_ID => $idTrabajador,
          pagoTrabajadorTableClass::VALOR_SALARIO => $valor,
          pagoTrabajadorTableClass::CANTIDAD_HORAS_EXTRAS => $cantidad,
          pagoTrabajadorTableClass::VALOR_HORAS_EXTRAS => $valorHoras,
          pagoTrabajadorTableClass::HORAS_PERDIDAS => $horas,
          pagoTrabajadorTableClass::TOTAL_PAGAR => $total
            
        );
        pagoTrabajadorTableClass::insert($data);
        session::getInstance()->setSuccess('El registro fue Exitoso');
        routing::getInstance()->redirect('pagoTrabajador', 'index');
      } else {
        routing::getInstance()->redirect('pagoTrabajador', 'index');
      }
    } catch (PDOException $exc) {
      routing::getInstance()->redirect('pagoTrabajador', 'insert');
      session::getInstance()->setFlash('exc', $exc);
    }
  }

public function validate($valor, $cantidad, $valorHoras, $horas, $total) {

    $flag = false;
    $patron = "/^[[:digit:]]+$/";
//---------------------validacion Valor----------------------------------- 
    
    if (strlen($valor) > pagoTrabajadorTableClass::VALOR_SALARIO_LENGTH) {
      session::getInstance()->setError(i18n::__(00004, null, 'errors', array(':longitud' => pagoTrabajadorTableClass::VALOR_SALARIO_LENGTH)), 00004);
      $flag = true;
    }   
   
    if (!is_numeric($valor) === "" or $valor === null) {
      session::getInstance()->setError(i18n::__(00009, null, 'errors', array(':campo vacio' => pagoTrabajadorTableClass::VALOR_SALARIO)), 00009);
      $flag = true;
    }
    
    if (!preg_match($patron, $valor)) {
      session::getInstance()->setError(i18n::__(00010, null, 'errors', array(':numeros' => $valor)), 00010);
      $flag = true;
       }
//-----------------------validacion Cantidad-----------------------------------------    
     if (!is_numeric($cantidad) === "" or $cantidad === null) {
      session::getInstance()->setError(i18n::__(00009, null, 'errors', array(':campo vacio' => pagoTrabajadorTableClass::CANTIDAD_HORAS_EXTRAS)), 00009);
      $flag = true;
    }
    
    if (strlen($cantidad) > pagoTrabajadorTableClass::CANTIDAD_HORAS_EXTRAS_LENGTH) {
      session::getInstance()->setError(i18n::__(00014, null, 'errors', array(':longitud' => pagoTrabajadorTableClass::CANTIDAD_HORAS_EXTRAS_LENGTH)), 00014);
      $flag = true;
    } 

    if (!preg_match($patron, $cantidad)) {
      session::getInstance()->setError(i18n::__(00010, null, 'errors', array(':numeros' => $cantidad)), 00010);
      $flag = true;
       }
//-----------------------validacion Valor de horas extras--------------------------------------------  
    if (!is_numeric($valorHoras) === "" or $valorHoras === null) {
      session::getInstance()->setError(i18n::__(00009, null, 'errors', array(':campo vacio' => pagoTrabajadorTableClass::VALOR_HORAS_EXTRAS)), 00009);
      $flag = true;
    }
    
    if (strlen($valorHoras) > pagoTrabajadorTableClass::VALOR_HORAS_EXTRAS_LENGTH) {
      session::getInstance()->setError(i18n::__(00014, null, 'errors', array(':longitud' => pagoTrabajadorTableClass::VALOR_HORAS_EXTRAS_LENGTH)), 00014);
      $flag = true;
    } 

    if (!preg_match($patron, $valorHoras)) {
      session::getInstance()->setError(i18n::__(00010, null, 'errors', array(':numeros' => $valorHoras)), 00010);
      $flag = true;
       }
//-----------------------validacion horas--------------------------------------------  
    if (!is_numeric($horas) === "" or $horas === null) {
      session::getInstance()->setError(i18n::__(00009, null, 'errors', array(':campo vacio' => pagoTrabajadorTableClass::HORAS_PERDIDAS)), 00009);
      $flag = true;
    }
    
    if (strlen($horas) > pagoTrabajadorTableClass::HORAS_PERDIDAS_LENGTH) {
      session::getInstance()->setError(i18n::__(00014, null, 'errors', array(':longitud' => pagoTrabajadorTableClass::HORAS_PERDIDAS_LENGTH)), 00014);
      $flag = true;
    } 

    if (!preg_match($patron, $horas)) {
      session::getInstance()->setError(i18n::__(00010, null, 'errors', array(':numeros' => $horas)), 00010);
      $flag = true;
       }
//-----------------------validacion Total--------------------------------------------  
    if (!is_numeric($total) === "" or $total === null) {
      session::getInstance()->setError(i18n::__(00009, null, 'errors', array(':campo vacio' => pagoTrabajadorTableClass::TOTAL_PAGAR)), 00009);
      $flag = true;
    }
    
    if (strlen($total) > pagoTrabajadorTableClass::TOTAL_PAGAR_LENGTH) {
      session::getInstance()->setError(i18n::__(00014, null, 'errors', array(':longitud' => pagoTrabajadorTableClass::TOTAL_PAGAR_LENGTH)), 00014);
      $flag = true;
    } 

    if (!preg_match($patron, $total)) {
      session::getInstance()->setError(i18n::__(00010, null, 'errors', array(':numeros' => $total)), 00010);
      $flag = true;
       }
       
    if ($flag === true){
      request::getInstance()->setMethod('GET');
      routing::getInstance()->forward('pagoTrabajador', 'insert');
    }
  }

}
