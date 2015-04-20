<?php

/**
 * Description of installerClass
 *
 * @author julianlasso
 */
class installerClass {

  public function install() {
    if (isset($_GET['step']) !== true) {
      include_once 'view/index.html.php';
    } else {
      switch ($_GET['step']) {
        case 2:
          include_once 'view/dataBase.html.php';
          break;
        case 3:
          try {
            $dsn = $_POST['driver'] . ':dbname=' . $_POST['dbName'] . ';host=' . $_POST['host'] . ';port=' . $_POST['port'];
            $usuario = $_POST['dbUser'];
            $contrasena = $_POST['dbPass'];
            $gbd = new PDO($dsn, $usuario, $contrasena);

            $_SESSION['driver'] = $_POST['driver'];
            $_SESSION['host'] = $_POST['host'];
            $_SESSION['port'] = $_POST['port'];
            $_SESSION['dbUser'] = $_POST['dbUser'];
            $_SESSION['dbPass'] = $_POST['dbPass'];
            $_SESSION['dbName'] = $_POST['dbName'];

            include_once 'view/configuration.html.php';
          } catch (PDOException $exc) {
            $_GET['error'] = true;
            $_GET['error_message'] = $exc->getMessage();
            include_once 'view/dataBase.html.php';
          }
          break;
        case 4:
          $flag = true;

          /*
           * realizar las validaciones
           */

          if ($flag === true) {
            $driver = $_SESSION['driver'];
            $host = $_SESSION['host'];
            $port = $_SESSION['port'];
            $dbUser = $_SESSION['dbUser'];
            $dbPass = $_SESSION['dbPass'];
            $dbName = $_SESSION['dbName'];
            $RowGrid = $_POST['RowGrid'];
            $PathAbsolute = $_POST['PathAbsolute'];
            $UrlBase = $_POST['UrlBase'];
            $Scope = $_POST['Scope'];
            $idioma = $_POST['idioma'];
            $FormatTimestamp = $_POST['FormatTimestamp'];
            include_once 'ejemplo.php';

            $file = fopen('../config/config.php', 'w');
            fputs($file, $config);
            fclose($file);

            // aqui falta correr el archivo SQL en la base de datos

            $host = 'localhost';
            $db = 'ejemplo';
            $username = 'postgres';
            $password = 'root';
            $dsn = "pgsql:host=$host;port=5432;dbname=$db;user=$username;password=$password";


            
            $gbd = new PDO($dsn);
            try {
              $query = $gbd->prepare ("CREATE TABLE usuario(nombre varchar(80))");
              $query->execute();
              // display a message if connected to the PostgreSQL successfully
              if ($conn) {
                echo "Se conecto la Base de Datos <strong>$db</strong> Exitosamente y tablas!";
              }
            } catch (PDOException $e) {
              // report error message
              echo $e->getMessage();
            }

//            try {
//              
//              $usuario = "postgres";
//              $contrasena = "root";
//              $dbName = "ejemplo";
//              $host = "localhost";
//              $pgsql = new PDO('pgsql:dbname=$dbName;'
//                      . 'host=$host;'
//                      , $usuario, $contrasena ); 
//              $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//              
//            } catch (PDOException $e) {
//              echo 'Error conectando con la base de datos: ' . $e->getMessage();
//            }
//            $fp = fopen('../sql/bdagricola.sql','r');
//            if (!$fp) {echo 'ERROR: No ha sido posible abrir el archivo. Revisa su nombre y sus permisos.'; exit;}
//            fclose($fp);
//            include_once 'view/felicidades.html.php';
          } else {
            include_once 'view/configuration.html.php';
          }

          break;
      }
    }
  }

}
