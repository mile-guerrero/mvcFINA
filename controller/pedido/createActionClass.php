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
 * @author 
 */
class createActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')) {

        $idEmpresa = request::getInstance()->getPost(pedidoTableClass::getNameField(pedidoTableClass::EMPRESA_ID, true));
        $idProveedor = request::getInstance()->getPost(pedidoTableClass::getNameField(pedidoTableClass::ID_PROVEEDOR, true));
        $cantidad = request::getInstance()->getPost(pedidoTableClass::getNameField(pedidoTableClass::CANTIDAD, true));
        $idProducto = request::getInstance()->getPost(pedidoTableClass::getNameField(pedidoTableClass::PRODUCTO_INSUMO_ID, true));
        
//        if (strlen($nombre) > credencialTableClass::NOMBRE_LENGTH) {
//          throw new PDOException(i18n::__(00001, null, 'errors', array(':longitud' => credencialTableClass::NOMBRE_LENGTH)), 00001);
//        }
        $this->validate($cantidad);

        $data = array(
            pedidoTableClass::EMPRESA_ID => $idEmpresa,
            pedidoTableClass::ID_PROVEEDOR => $idProveedor,
            pedidoTableClass::CANTIDAD => $cantidad,
            pedidoTableClass::PRODUCTO_INSUMO_ID => $idProducto
          
        );
        pedidoTableClass::insert($data);
        session::getInstance()->setSuccess('El registro fue exitoso');
        routing::getInstance()->redirect('pedido', 'index');
      } else {
        routing::getInstance()->redirect('pedido', 'index');
      }
    } catch (PDOException $exc) {
      routing::getInstance()->redirect('pedido', 'insert');
      session::getInstance()->setFlash('exc', $exc);
    }
  }

public function validate($cantidad) {

    $flag = false;
    $patron = "/^[[:digit:]]+$/";
//---------------------validacion descripcion----------------------------------- 
    
    if (strlen($cantidad) > pedidoTableClass::CANTIDAD_LENGTH) {
      session::getInstance()->setError(i18n::__(00004, null, 'errors', array(':longitud' => pedidoTableClass::CANTIDAD_LENGTH)), 00004);
      $flag = true;
    } 
    
    if (!is_numeric($cantidad) == "" ) {
      session::getInstance()->setError(i18n::__(00009, null, 'errors', array(':campo vacio' => pedidoTableClass::CANTIDAD_LENGTH)), 00009);
      $flag = true;
    }
    
    if (!preg_match($patron, $cantidad)) {
      session::getInstance()->setError(i18n::__(00010, null, 'errors', array(':numeros' => $cantidad)), 00010);
      $flag = true;
       }
//-----------------------validacion --------------------------------------------    
    if ($flag === true){
      request::getInstance()->setMethod('GET');
      routing::getInstance()->forward('pedido', 'insert');
    }
  }

}
