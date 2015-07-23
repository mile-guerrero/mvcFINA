<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use mvc\validator\productoInsumoValidatorClass as validator;
use hook\log\logHookClass as log;

/**
 * Description of ejemploClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class createProductoInsumoActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')) {

        $descripcion = request::getInstance()->getPost(productoInsumoTableClass::getNameField(productoInsumoTableClass::DESCRIPCION, true));
        $iva = request::getInstance()->getPost(productoInsumoTableClass::getNameField(productoInsumoTableClass::IVA, true));
        $cantidad = request::getInstance()->getPost(productoInsumoTableClass::getNameField(productoInsumoTableClass::CANTIDAD, true));
        $unidad = request::getInstance()->getPost(productoInsumoTableClass::getNameField(productoInsumoTableClass::UNIDAD_MEDIDA_ID, true));
        $tipo = request::getInstance()->getPost(productoInsumoTableClass::getNameField(productoInsumoTableClass::TIPO_PRODUCTO_INSUMO_ID, true));


        $file = request::getInstance()->getFile(productoInsumoTableClass::getNameField(productoInsumoTableClass::NOMBRE_IMAGEN, true));
        
        validator::validateInsert();

        $long = -3;
        $ext = substr($file['name'], $long);
        if ($ext == 'JPG' or $ext =='jpg') {
              $ext = 'jpg';
             }
        $sizeKB = $file['size'] / 1024;
        $hashImagen = md5($file['name'] . strtotime(date(config::getFormatTimestamp()))) . '.' . $ext;


        if ($ext == "jpg" || $ext == "JPG" || $ext == "gif" || $ext == "png") {
          if (move_uploaded_file($file['tmp_name'], config::getPathAbsolute() . 'web/imgInsumo/' . $hashImagen) && ($sizeKB < 2048)) {
            
            //$extencion = substr($file['name'], $long);
            $hash = $file['type'];

            $data = array(
                productoInsumoTableClass::DESCRIPCION => $descripcion,
                productoInsumoTableClass::NOMBRE_IMAGEN => $file['name'],
                productoInsumoTableClass::EXTENCION_IMAGEN => $ext,
                productoInsumoTableClass::HASH_IMAGEN => $hashImagen,
                productoInsumoTableClass::IVA => $iva,
                productoInsumoTableClass::CANTIDAD => $cantidad,
                productoInsumoTableClass::UNIDAD_MEDIDA_ID => $unidad,
                productoInsumoTableClass::TIPO_PRODUCTO_INSUMO_ID => $tipo,
                '__sequence' => 'producto_insumo_id_seq'
            );
            $id = productoInsumoTableClass::insert($data);
            session::getInstance()->setSuccess('El Registro Fue Exitoso ');
            $observacion = 'se ha insertando un nuevo producto insumo';
            log::register('Insertar', productoInsumoTableClass::getNameTable(), $observacion, $id);
            routing::getInstance()->redirect('productoInsumo', 'indexProductoInsumo');
          } else {
//           validator::validateInsert();
//              session::getInstance()->setError('El archivo sobre pasa el peso minimo requerido', 'inputImagen');
//        routing::getInstance()->forward('productoInsumo', 'insertProductoInsumo');
       
//            session::getInstance()->setError('Hubo un error al grabar el archivo');
          }
        } else {
//          session::getInstance()->setError('No es un tipo de archivo válido');
        }
      }

    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }
  }

//public function validate($descripcion, $iva) {
//
//    $flag = false;
//    $patron = "/^[[:digit:]]+$/";
////---------------------validacion descripcion----------------------------------- 
//    
//    if (strlen($descripcion) > productoInsumoTableClass::DESCRIPCION_LENGTH) {
//      session::getInstance()->setError(i18n::__(00004, null, 'errors', array(':longitud' => productoInsumoTableClass::DESCRIPCION_LENGTH)), 00004);
//      $flag = true;
//    }   
//    
//
//    if (strlen($descripcion) == "" or $iva === null) {
//      session::getInstance()->setError(i18n::__(00009, null, 'errors', array(':campo vacio' => productoInsumoTableClass::DESCRIPCION)), 00009);
//      $flag = true;
//    }
////-----------------------validacion iva-----------------------------------------    
//     if (!is_numeric($iva) === "" or $iva === null) {
//      session::getInstance()->setError(i18n::__(00009, null, 'errors', array(':campo vacio' => productoInsumoTableClass::IVA)), 00009);
//      $flag = true;
//    }
//    
//    if (strlen($iva) > productoInsumoTableClass::IVA_LENGTH) {
//      session::getInstance()->setError(i18n::__(00014, null, 'errors', array(':longitud' => productoInsumoTableClass::IVA_LENGTH)), 00014);
//      $flag = true;
//    } 
//
//    if (!preg_match($patron, $iva)) {
//      session::getInstance()->setError(i18n::__(00010, null, 'errors', array(':no permite letras' => productoInsumoTableClass::IVA)), 00010);
//      $flag = true;
//       }
////-----------------------validacion --------------------------------------------    
//    if ($flag === true){
//      request::getInstance()->setMethod('GET');
//      routing::getInstance()->forward('productoInsumo', 'insertProductoInsumo');
//    }
//  }
}
