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
class createActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')) {

        $fecha = request::getInstance()->getPost(ordenServicioTableClass::getNameField(ordenServicioTableClass::FECHA_MANTENIMIENTO, true));
        $trabajador = request::getInstance()->getPost(ordenServicioTableClass::getNameField(ordenServicioTableClass::TRABAJADOR_ID, true));
        $cantidad = request::getInstance()->getPost(ordenServicioTableClass::getNameField(ordenServicioTableClass::CANTIDAD, true));
        $valor = request::getInstance()->getPost(ordenServicioTableClass::getNameField(ordenServicioTableClass::VALOR, true));
        $producto = request::getInstance()->getPost(ordenServicioTableClass::getNameField(ordenServicioTableClass::PRODUCTO_INSUMO_ID, true));
        $maquina = request::getInstance()->getPost(ordenServicioTableClass::getNameField(ordenServicioTableClass::MAQUINA_ID, true));

        $this->validate($cantidad, $valor);

        $data = array(
            ordenServicioTableClass::FECHA_MANTENIMIENTO => $fecha,
            ordenServicioTableClass::TRABAJADOR_ID => $trabajador,
            ordenServicioTableClass::CANTIDAD => $cantidad,
            ordenServicioTableClass::VALOR => $valor,
            ordenServicioTableClass::PRODUCTO_INSUMO_ID => $producto,            
            ordenServicioTableClass::MAQUINA_ID => $maquina
            
        );
        ordenServicioTableClass::insert($data);
        session::getInstance()->setSuccess('El registro fue exitoso');
        routing::getInstance()->redirect('ordenServicio', 'index');
      } else {
        routing::getInstance()->redirect('ordenServicio', 'index');
      }
    } catch (PDOException $exc) {
      routing::getInstance()->redirect('ordenServicio', 'insert');
      session::getInstance()->setFlash('exc', $exc);
    }
  }

public function validate($cantidad, $valor) {

    $flag = false;
    $patron = "/^[[:digit:]]+$/";
//---------------------validacion descripcion----------------------------------- 
    
    if (strlen($cantidad) > ordenServicioTableClass::CANTIDAD_LENGTH) {
      session::getInstance()->setError(i18n::__(00004, null, 'errors', array(':longitud' => ordenServicioTableClass::CANTIDAD_LENGTH)), 00004);
      $flag = true;
    } 
    
    if (!is_numeric($cantidad) == "" ) {
      session::getInstance()->setError(i18n::__(00009, null, 'errors', array(':campo vacio' => ordenServicioTableClass::CANTIDAD)), 00009);
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
    
    if (strlen($valor) > ordenServicioTableClass::VALOR_LENGTH) {
      session::getInstance()->setError(i18n::__(00014, null, 'errors', array(':longitud' => ordenServicioTableClass::VALOR_LENGTH)), 00014);
      $flag = true;
    } 

    if (!preg_match($patron, $valor)) {
      session::getInstance()->setError(i18n::__(00010, null, 'errors', array(':numeros' => $valor)), 00010);
      $flag = true;
       }
//-----------------------validacion --------------------------------------------    
    if ($flag === true){
      request::getInstance()->setMethod('GET');
      routing::getInstance()->forward('ordenServicio', 'insert');
    }
  }

}






 

        
            
           
        