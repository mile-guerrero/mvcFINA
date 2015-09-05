<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use mvc\validator\detalleFacturaVentaValidatorClass as validator;

/**
 * Description of ejemploClass
 *
 * @author Andres Bahamon
 */
class getInsumoActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST') and request::getInstance()->isAjaxRequest()) {

        $idTipoInsumo = request::getInstance()->getPost('idTipoInsumo');
        $ConsultaInsumoDescripcion = detalleFacturaVentaTableClass::getTraerInsumo($idTipoInsumo);
        $ConsultaInsumoId = detalleFacturaVentaTableClass::getTraerId($idTipoInsumo);
        
//        print_r($ConsultaInsumoDescripcion);
//            print_r($ConsultaInsumoId);
//        exit();
//        
        // crear SQL
        $arrayAjax1 = array();
        foreach ($ConsultaInsumoId as $key){
           
               print_r($ConsultaInsumoId);
              
        }
        $arrayAjax2 = array();
        foreach ($ConsultaInsumoDescripcion as $key){
           $arrayAjax2 = array(
                    'name'=>$key->descripcion                    
                );
        }
        print_r($arrayAjax1);
            print_r($arrayAjax2);
        exit();
//     $this->arrayAjax = $arrayAjax1.$arrayAjax2;
        
//        $this->arrayAjax = array(
//            array(
//                'id' => 98,
//                'name' => 'Fruta1'
//            ),
//            array(
//                'id' => 9,
//                'name' => 'Fruta2'
//            ),
//            array(
//                'id' => 8,
//                'name' => 'Fruta3'
//            )
//        );
        
        $this->defineView('getInsumo', 'detalleFacturaVenta', session::getInstance()->getFormatOutput());
      } else {
        routing::getInstance()->redirect('facturaVenta', 'index');
      }
    } catch (PDOException $exc) {
      routing::getInstance()->redirect('detalleFacturaVenta', 'insert');
      session::getInstance()->setFlash('exc', $exc);
    }
  }

}
