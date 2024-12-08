<?php

session_start();

if (!isset($_SESSION["active"])) {
  header("location: ingresar.php");
  die();
}

if (isset($_SESSION["active"]) && $_SESSION["rol"] != 'usuario') {
  header("location: admin.php");
  die();
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inicio | Andres Remodelaciones</title>
  <link rel="stylesheet" href="../css/inicio.css">
</head>

<body>
  <?php if (isset($_GET["mensaje"])) : ?>
    <div id="mensaje">
      <strong>Exito</strong>
      <span><?= $_GET["mensaje"] ?></span>
    </div>
  <?php endif ?>

  <div id="header_usuario">
    <h1>Bienvenido a tu cuenta!</h1>
    <p>A continuación podrás ver el catalogo de servicios que ofrecemos</p>
    <form method="GET" action="../controller/salir.php">
      <button type="submit">Cerrar Sesión</button>
    </form>
  </div>

  <div>
    <h2 id="titulo-pqr">PQR</h2>
    <div id="formulario-pqr">
      <h3>Atraves de este formulario puedes realizar PQR</h3>
      <form method="post" action="../controller/nuevo_pqr.php">
        <div>
          <label for="tipo_solicitud">Tipo de solicitud</label>
          <select id="tipo_solicitud" name="tipo_solicitud">
            <option value="peticion">Petición</option>
            <option value="queja">Queja</option>
            <option value="reclamo">Reclamo</option>
          </select>
        </div>
        <div>
          <label for="texto">Texto PQR</label>
          <textarea rows="5" require id="texto" name="texto" placeholder="Escribe tu comentario aquí..."></textarea>
        </div>
        <button type="submit">Enviar</button>
      </form>
    </div>
  </div>

  <div class="contenedor_productos">
    <div id="contenedor_catalogos">
      <div id="mensaje" class="mensaje-cotizacion" style="display: none;">
        <strong>Exito</strong>
        <span id="contenido-mensaje-cotizacion"></span>
      </div>

      <h2 id="titulo-catalogo">Listado de catalogos</h2>
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
          <button data-catalogo='" . $row["id"] . "' data-nombre='" . $row["nombre"] . "' data-usuario='" . $_SESSION['id'] . "' class='agregar-producto'>Agregar</button>
        </li>
      ";
      }

      echo "</ul>";
      ?>
    </div>

    <div id="contenedor_resultados" style="display: none;">
      <h2>Productos agregados</h2>
      <ul id="contenedor_resultados_lista"></ul>
      <button id="boton-cotizar">Enviar Cotización</button>
    </div>
  </div>

  <script src="../js/index.js"></script>
</body>

</html>