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
  <title>Registrarse | Andres Remodelaciones</title>
  <link rel="stylesheet" href="../css/registro.css">
</head>

<body>
  <h1>Registrate para realizar cotizaciones</h1>

  <?php if (isset($_GET["mensaje_error"])) : ?>
    <div id="mensaje_error">
      <strong>Error</strong>
      <span><?= $_GET["mensaje_error"] ?></span>
    </div>
  <?php endif ?>

  <form method="post" action="../controller/registro_usuario.php">
    <div>
      <label for="nombre">Nombre y Apellido</label>
      <input type="text" id="nombre" name="nombre" require placeholder="Nombre y Apellido" />
    </div>
    <div>
      <label for="cc">CC</label>
      <input type="text" id="cc" placeholder="CC" require name="cedula" />
    </div>
    <div>
      <label for="direccion">Dirección</label>
      <input type="text" id="direccion" placeholder="Dirección" require name="direccion" />
    </div>
    <div>
      <label for="telefono">Teléfono</label>
      <input type="number" id="telefono" placeholder="Teléfono" require name="telefono" />
    </div>
    <div>
      <label for="correo">Correo electronico</label>
      <input type="email" id="correo" placeholder="Correo electronico" require name="email" />
    </div>
    <div>
      <label for="clave">Contraseña</label>
      <input type="password" id="clave" placeholder="**********" require name="clave" />
    </div>
    <div>
      <button type="submit">Registrarse</button>
    </div>
  </form>
</body>

</html>