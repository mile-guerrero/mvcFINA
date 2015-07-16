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
class verActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      
//      if ($directorio = opendir("./uploadArchivo")){ //ruta actual
//while ($archivo = readdir($directorio)) //obtenemos un archivo y luego otro sucesivamente
//{
//  $ext = substr($archivo, -3);//para poner icono
//  if($ext == 'pdf'){//para poner icono a pdf
//         echo '<img src="' . routing::getInstance()->getUrlImg('../img/reporte.gif') . '"/>' ;         
//      }
//   if($ext == 'zip'){//para poner icono a zip
//          echo '<img src="' . routing::getInstance()->getUrlImg('../img/iconZip.png') . '"/>' ;         
//      }
//   if($ext == 'txt'){//para poner icono a zip
//         echo '<img src="' . routing::getInstance()->getUrlImg('../img/iconTxt.png') . '"/>' ;         
//      }
//      $extOfice = substr($archivo, -4);
//   if($extOfice == 'docx'){//para poner icono a word
//          echo '<img src="' . routing::getInstance()->getUrlImg('../img/iconWord.png') . '"/>' ;         
//      }
//   if($extOfice == 'xlsx'){//para poner icono a word
//          echo '<img src="' . routing::getInstance()->getUrlImg('../img/iconExel.png') . '"/>' ;         
//      }
//    
//    if ($archivo != '.' && $archivo != '..')//verificamos si es o no un directorio
//
//    {
//      $this->archivo = $archivo;
//      echo $archivo;
////     echo "Archivo: <strong>  $archivo </strong><br />" ; 
////     echo '<form class="form-horizontal" id="filterForm" role="form" method="POST" action="'. routing::getInstance()->getUrlWeb('archivo', 'eliminar'). '">' ;
////     echo '<input type="hidden" class="form-control" id="filterDocumento" name="filter[documento]"  value="' . htmlspecialchars($archivo) . '" />'."\n";
////     echo  '<input class="btn btn-danger btn-xs" type="submit" value="'. i18n::__(((isset($objArchivo)) ? 'update' : 'eliminar')) .'">';
////     echo '<br><br>';
////     echo '</form>';
//  }}}
 $where = null;
      
     $fields = array(
          archivoTableClass::ID,
          archivoTableClass::NOMBRE,
          archivoTableClass::EXTENCION,
          archivoTableClass::HASH
      );
           
      $this->objArchivo = archivoTableClass::getAll($fields, false, null, null, null, null, $where);
      
  
      $this->defineView('ver', 'archivo', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }
  }

}
