<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use mvc\validator\viveroValidatorClass as validator;
use hook\log\logHookClass as log;
/**
 * Description of ejemploClass
 *
 * @author Gonzalo Andres Bejarano, Elcy Milena Guerrero, Andres Eduardo Bahamon
 */
class createActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')) {

        $fechaInicial = request::getInstance()->getPost(viveroTableClass::getNameField(viveroTableClass::FECHA_INICIAL, true));
        $fechaFinal = request::getInstance()->getPost(viveroTableClass::getNameField(viveroTableClass::FECHA_FINAL, true));
        $cantidad = request::getInstance()->getPost(viveroTableClass::getNameField(viveroTableClass::CANTIDAD, true));
        $idProducto = request::getInstance()->getPost(viveroTableClass::getNameField(viveroTableClass::PRODUCTO_INSUMO_ID, true));
        
//        if (strlen($nombre) > credencialTableClass::NOMBRE_LENGTH) {
//          throw new PDOException(i18n::__(00001, null, 'errors', array(':longitud' => credencialTableClass::NOMBRE_LENGTH)), 00001);
//        }
                validator::validateInsert();
                
            if($fechaFinal < $fechaInicial){
                session::getInstance()->setFlash('selectFechaInicial', true);
                session::getInstance()->setError('La fecha final no puede ser menor a la actual', 'selectFechaInicial');
                routing::getInstance()->forward('vivero', 'insert');
            }elseif($fechaFinal == $fechaInicial){
                session::getInstance()->setFlash('selectFechaInicial', true);
                session::getInstance()->setError('La fecha final es igual a la actual', 'selectFechaInicial');
                routing::getInstance()->forward('vivero', 'insert');
            }
                
                if($cantidad <= 0){
                session::getInstance()->setFlash('inputCantidad', true);
                session::getInstance()->setError('Los valores numericos no pueden ser negativos', 'inputCantidad');
                routing::getInstance()->forward('vivero', 'insert');
            }

        $data = array(
            viveroTableClass::FECHA_INICIAL => $fechaInicial,
            viveroTableClass::FECHA_FINAL => $fechaFinal,
            viveroTableClass::CANTIDAD => $cantidad,
            viveroTableClass::PRODUCTO_INSUMO_ID => $idProducto,
            '__sequence' => 'vivero_id_seq'
        );
        $id = viveroTableClass::insert($data);
        session::getInstance()->setSuccess('El registro fue exitoso');
        $observacion ='se ha insertando una nuevo vivero';
        log::register('Insertar', viveroTableClass::getNameTable(),$observacion,$id);
        routing::getInstance()->redirect('vivero', 'index');
      } else {
        routing::getInstance()->redirect('vivero', 'index');
      }
    } catch (PDOException $exc) {
      routing::getInstance()->redirect('vivero', 'insert');
      session::getInstance()->setFlash('exc', $exc);
    }
  }

}
