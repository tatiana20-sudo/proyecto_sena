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
  <title>Andres Remodelaciones</title>
  <link rel="stylesheet" href="css/inicio.css">
</head>

<body>
  <main>
    <header>

      <?php if (isset($_GET["mensaje"])) : ?>
        <div id="mensaje">
          <strong>Exito</strong>
          <span><?= $_GET["mensaje"] ?></span>
        </div>
      <?php endif ?>

      <h1>Bienvenido a Andres Remodelaciones</h1>
      <div>
        <a href="views/ingresar.php">Ingresar</a>
        <a href="views/registrarse.php">Registrarse</a>
      </div>
    </header>

    <div>
      <p>A continuación podrás ver nuestro catalogo de servicios en estruturas livianas o acabados que ofrecemos a nuestros clientes</p>
      <h2>Servicios</h2>
      <ul>
        <li>Divisiones en Drywall</li>
        <li>Divisiones en Super Board o Fibrocemento</li>
        <li>Pisos flotantes SPC o Laminados</li>
        <li>Acabados con Lamina UP o Marmól</li>
        <li>Acabados con Lamina WPC</li>
        <li>Montaje de laminas de Policarbonato</li>
        <li>Tejados tipo colonial o UPC</li>
        <li>Cielos Razos en PVC y Drywall</li>
        <li>Termoacústica</li>
        <li>Relacionados Estuco y Pintura</li>
        <li>Relacionados con Drywall</li>
      </ul>
    </div>

    <div>
      <h2>Visitas</h2>
      <div>
        <ul>
          <li>Visitas con el técnico</li>
          <li>Agendamientos y Cotizaciones</li>
          <li>Arreglos en general</li>
        </ul>
      </div>
    </div>

    <div>
      <h2>Preguntas frecuentes</h2>
      <div>
        <ul>
          <li>
            <b>¿Como solicito una cotización?</b>
            <span>
              Debes ingresar con tu usuario y contraseña, en caso de no tener un usuario puedes registrarte
              <a href="registrarse.html">aquí</a>. Una vez ingreses debes darle al botón <i>Cotizaciones</i>
            </span>
          </li>
          <li>
            <b>¿En caso de alguna duda donde me puedo comunicar?</b>
            <span>
              Puedes enviar un correo al correo electrónico <a href="mail:soporte@andresremodelaciones.com">soporte@andresremodelaciones.com</a>
              ó puedes comunicarte al número <a href="tel:+57 331 456 7890">+57 331 456 7890</a>
            </span>
          </li>
        </ul>
      </div>
    </div>

    <div>
      <h2 id="titulo-comentarios">Comentarios</h2>
      <div>
        <h3>Algunos de los comentarios que dejaron nuestros clientes</h3>
        <div>
          <p>Me parecio excelente el servicio, todo muy bien y muy amables.</p>
          <b>Pepito Perez</b>
        </div>
        <div>
          <p>Una cosita quedo un poco mal arreglada, pero solicite la garantia y fue super rapido!</p>
          <b>Armando Casas</b>
        </div>
      </div>
    </div>

    <footer>
      <p><b>Contactanos por correo electronico:</b> soporte@andresremodelaciones.com</p>
      <p><b>Contactanos al número de télefono:</b> +57 331 456 7890</p>
      <p>Derechos de autor Andres Remodelaciones 2024</p>
    </footer>
  </main>
</body>

</html>