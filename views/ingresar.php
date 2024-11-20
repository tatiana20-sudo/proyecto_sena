<?php

session_start();

if (isset($_SESSION["active"]) && $_SESSION['active'] == 1 && $_SESSION['rol'] == "usuario") {
  header("location: views/usuario.php");
  die();
}

if (isset($_SESSION["active"]) && $_SESSION['active'] == 1 && $_SESSION['rol'] == "admin") {
  header("location: views/admin.php");
  die();
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ingresar | Andres Remodelaciones</title>
  <link rel="stylesheet" href="../css/ingresar.css">
</head>

<body>
  <h1>Ingresa para realizar cotizaciones</h1>

  <form method="post" action="../controller/ingresar.php">
    <?php if (isset($_GET["mensaje_error"])) : ?>
      <div id="mensaje_error">
        <strong>Error</strong>
        <span><?= $_GET["mensaje_error"] ?></span>
      </div>
    <?php endif ?>
    <div>
      <label for="correo">Correo o usuario</label>
      <input type="text" id="correo" name="correo" placeholder="Correo o usuario" />
    </div>
    <div>
      <label for="clave">Contraseña</label>
      <input type="password" id="clave" name="clave" placeholder="************" />
    </div>
    <a href="/recuperar">Recordar contraseña</a>
    <div>
      <button type="submit">Ingresar</button>
    </div>
  </form>
</body>

</html>