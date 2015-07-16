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
 * @author Gonzalo Andres Bejarano, Elcy Milena Guerrero, Andres Eduardo Bahamon
 */
class deleteActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
//      $directorio = opendir("./uploadArchivo");
//      $archivo = readdir($directorio);
//      $ext = substr('381ee3afe6d38f12221ab01e551fd7b6.pdf', -3);
//      print_r($ext);
//     
//     if($ext == 'pdf'){
//          echo '<img src="' . routing::getInstance()->getUrlImg('../img/reporte.gif') . '"/>' ;         
//      }
     

//        $file = request::getInstance()->getFile(usuarioTableClass::getNameField(usuarioTableClass::USUARIO, true));
//        $ext = substr($file['name'], -3);
//        
        
//        $tamano_archivo = substr($file['size'], -6, 6);
//        $nameFile = md5($file['name'] . strtotime(date(config::getFormatTimestamp()))) . '.' . $ext;
          
        // force_download(config::getPathAbsolute() . 'web/uploadArchivo/f31818b872312795be63bfb08a9d3101.pdf'); 
      
//      if ($directorio = opendir("./uploadArchivo")){ //ruta actual
//while ($archivo = readdir($directorio)) //obtenemos un archivo y luego otro sucesivamente
//{
//    if ($archivo != '.' && $archivo != '..')//verificamos si es o no un directorio
//    {
//      
////    echo '<br>';
////       print_r($dirint);
////       echo '</br>';
//     // unlink(config::getPathAbsolute() . 'web/uploadArchivo/' . $dirint); //aqui es para eliminar un archivo
//     //echo "Archivo: <strong>  $archivo </strong><br />" ; 
//    
//       }
//   
//        
//     }
//  
//    }
  
//      if (request::getInstance()->hasPost('filter')) {
//        $filter = request::getInstance()->getPost('filter');
//        //Validar datos
//       
//        if (request::getInstance()->isMethod('POST')) {
//           $documento = $filter['documento'];
//        if (isset($filter['documento']) and $filter['documento'] !== null and $filter['documento'] !== '') {
//          unlink(config::getPathAbsolute() . 'web/uploadArchivo/' . $filter['documento']);
//          session::getInstance()->setSuccess('El Archivo Fue Eliminado Exitosamente');
//        }//cierre del filtro documento
//      
//      }
//      
//        } 
      if (request::getInstance()->isMethod('POST')and request::getInstance()->isAjaxRequest()) {    

        $id = request::getInstance()->getPost(videoTableClass::getNameField(videoTableClass::HASH, true));
        
        $ids = array(
            videoTableClass::ID => $id
        );
       videoTableClass::delete($ids, false);
       
        $this->arrayAjax = array(
            'code'=> 200,
            'msg'=> 'Eliminacion exitosa'
            );
        session::getInstance()->setSuccess('El campo Fue Eliminado Exitosamente');
        
          
        $this->defineView('delete', 'imagen', session::getInstance()->getFormatOutput());
        
      
      }//cierre del if
       else {
        routing::getInstance()->redirect('imagen', 'ver');
      }//cierre del else

      //------------------------------------------------------------------------
      $this->defineView('ver', 'archivo', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }
  }

}
