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


        $data = array(
            ordenServicioTableClass::FECHA_MANTENIMIENTO => $fecha,
            ordenServicioTableClass::TRABAJADOR_ID => $trabajador,
            ordenServicioTableClass::CANTIDAD => $cantidad,
            ordenServicioTableClass::VALOR => $valor,
            ordenServicioTableClass::PRODUCTO_INSUMO_ID => $producto,            
            ordenServicioTableClass::MAQUINA_ID => $maquina
            
        );
        ordenServicioTableClass::insert($data);
        routing::getInstance()->redirect('ordenServicio', 'index');
      } else {
        routing::getInstance()->redirect('ordenServicio', 'index');
      }
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }
  }

}






 

        
            
           
        