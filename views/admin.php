<?php

session_start();

if (!isset($_SESSION["active"])) {
  header("location: ingresar.php");
  die();
}

if (isset($_SESSION["active"]) && $_SESSION["rol"] != 'admin') {
  header("location: usuario.php");
  die();
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inicio Admin | Andres Remodelaciones</title>
  <link rel="stylesheet" href="../css/inicio.css">
</head>

<body>
  <div id="header_usuario">
    <h1>Bienvenido a tu cuenta: Administrador!</h1>
    <p>Aquí podrás crear nuevos registros al catalogo</p>
    <form method="GET" action="../controller/salir.php">
      <button type="submit">Cerrar Sesión</button>
    </form>
  </div>

  <div id="contenedor_formulario_catalogo">

    <?php if (isset($_GET["mensaje_error"])) : ?>
      <div id="mensaje_error">
        <strong>Error</strong>
        <span><?= $_GET["mensaje_error"] ?></span>
      </div>
    <?php endif ?>

    <?php if (isset($_GET["mensaje"])) : ?>
      <div id="mensaje">
        <strong>Exito</strong>
        <span><?= $_GET["mensaje"] ?></span>
      </div>
    <?php endif ?>

    <h4>Formulario agregar nuevo registro al catalogo</h4>
    <form method="post" action="../controller/catalogo.php" enctype="multipart/form-data">
      <div>
        <label for="nombre">Nombre del registro</label>
        <input type="text" id="nombre" name="nombre" placeholder="Por ejemplo: Drywall" />
      </div>
      <div>
        <label for="imagen">Selecciona una imagen</label>
        <input type="file" name="imagen" id="imagen">
      </div>
      <div>
        <button type="submit">Enviar</button>
      </div>
    </form>
  </div>

  <div id="contenedor_catalogos">
    <h4>Listado de catalogos</h4>
    <?php
    require_once "../conexion/conn.php";

    $db = database::conectar();

    $statement = $db->query("SELECT * FROM catalogo");

    echo "<ul>";

    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {

      echo "
        <li>
          <h4>" . $row["nombre"] . "</h4>
          <img width='100' height='100' src='" . $row['imagen'] . "' />
        </li>
      ";
    }

    echo "</ul>";
    ?>
  </div>

  <div id="contenedor_pqrs">
    <h4>Listado de PQRs</h4>
    <?php
    require_once "../conexion/conn.php";

    $db = database::conectar();

    $statement = $db->query("SELECT p.texto, p.tipo, u.nombre, u.email FROM pqr AS p INNER JOIN usuarios AS u ON u.id = p.usuarios_id");

    echo "<ul>";

    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {

      echo "
        <li>
          <h4>" . $row["nombre"] . ": " . $row["email"] . "</h4>
          <p>" . $row["tipo"] . ": " . $row["texto"] . "</p>
        </li>
      ";
    }

    echo "</ul>";
    ?>
  </div>

  <div id="contenedor_pqrs">
    <h4>Listado de cotizaciones</h4>
    <?php
    require_once "../conexion/conn.php";

    $db = database::conectar();

    $statement = $db->query("SELECT .u.id as usuarioId, u.nombre, u.email, u.telefono, c.nombre as catalogoNombre, c.id as catalogoId
      FROM catalogo_has_usuarios cu 
      INNER JOIN usuarios AS u
        ON u.id = cu.usuarios_id
      INNER JOIN catalogo AS c
        ON c.id = cu.catalogo_id");

    $usuarios = [];

    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
      if (!isset($usuarios[$row['usuarioId']])) {
        $usuarios[$row['usuarioId']] = [
          'nombre' => $row['nombre'],
          'email' => $row['email'],
          'telefono' => $row['telefono'],
          'productos' => []
        ];
      }

      $usuarios[$row['usuarioId']]['productos'][] = [
        'catalogoId' => $row['catalogoId'],
        'catalogoNombre' => $row['catalogoNombre']
      ];
    }

    echo "<ul>";

    foreach ($usuarios as $usuario) {
      echo "<li>
            <h4>" . $usuario['nombre'] . ": " . $usuario['email'] . ", Telefono: " . $usuario['telefono'] . "</h4>
            <ul>";

      foreach ($usuario['productos'] as $producto) {
        echo "<li>" . $producto['catalogoNombre'] . "</li>";
      }

      echo "</ul></li>";
    }

    echo "</ul>";
    ?>
  </div>
</body>

</html>