<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title></title>
  </head>
  <body>
    <form action="index.php?step=4" method="POST">
      <input value="<?php echo (isset($_POST['RowGrid'])) ? $_POST['RowGrid'] : '' ?>" type="text" name="RowGrid" placeholder="Numero de lineas por regilla"><br>
      <input value="<?php echo (isset($_POST['PathAbsolute'])) ? $_POST['PathAbsolute'] : '' ?>"  type="text" name="PathAbsolute" placeholder="Dirección en servidor de la carpeta raíz"><br>
      <input value="<?php echo (isset($_POST['UrlBase'])) ? $_POST['UrlBase'] : '' ?>" type="text" name="UrlBase" placeholder="Dirección de la web"><br>
      <select name="Scope">
        <option value="">Seleccione modo de instalación</option>
        <option value="dev">Desarrollo</option>
        <option value="prod">Producción</option>
      </select><br>
      <select name="idioma">
        <option value="">Seleccione idioma</option>
        <option value="es">Español</option>
        <option value="en">English</option>
      </select><br>
      <input value="<?php echo (isset($_POST['FormatTimestamp'])) ? $_POST['FormatTimestamp'] : '' ?>" type="text" name="FormatTimestamp" value="Y-m-d H:i:s" placeholder="Formato de fecha y hora"><br>
      <input type="submit" value="Instalar">
    </form>
  </body>
</html>
