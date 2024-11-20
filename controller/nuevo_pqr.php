<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Creando PRQ</title>
</head>

<body>
  <p>Creando nueva PQR, espera un momento por favor.</p>

  <?php

  class PqrController
  {

    public function nuevoPqr($tipo, $texto)
    {
      session_start();

      require_once '../conexion/conn.php';

      $db = database::conectar();

      $statement = $db->prepare("INSERT INTO pqr(tipo, texto, usuarios_id) VALUES(:tipo, :texto, :usuario_id)");
      $statement->execute(array(':tipo' => $tipo, ':texto' => $texto, ':usuario_id' => $_SESSION["id"]));

      header("Location: ../views/usuario.php?mensaje=Tu PQR se registro correctamente");
      die();
    }
  }

  $pqrController = new PqrController();
  $pqrController->nuevoPqr($_POST["tipo_solicitud"], $_POST["texto"]);

  ?>
</body>

</html>