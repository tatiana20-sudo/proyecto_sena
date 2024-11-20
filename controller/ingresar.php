<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Iniciando sesión</title>
</head>

<body>
  <p>Estamos inciando tu sesión, pronto seras redirigido</p>

  <?php

  class IngresarController
  {

    public function iniciarSesion($datos)
    {
      session_start();

      require_once '../conexion/conn.php';

      $db = database::conectar();

      $statement = $db->prepare("SELECT * FROM usuarios WHERE email = :email");
      $statement->execute(array(
        ':email' => $datos["correo"]
      ));

      $rows = $statement->fetchAll(PDO::FETCH_ASSOC);

      if (count($rows) == 0) {
        $_SESSION['active'] = 0;

        header("Location: ../views/ingresar.php?mensaje_error=Las credenciales son incorrectas");
        die();
      }

      if (!password_verify($datos["clave"], $rows[0]["clave"])) {
        $_SESSION['active'] = 0;

        header("Location: ../views/ingresar.php?mensaje_error=Las credenciales son incorrectas");
        die();
      }

      $rol = $rows[0]["rol"];
      $id = $rows[0]["id"];
      $_SESSION['active'] = 1;
      $_SESSION['rol'] = $rol;
      $_SESSION['id'] = $id;

      header("Location: ../views/" . $rol . ".php");
      die();
    }
  }

  $inicioController = new IngresarController();
  $inicioController->iniciarSesion($_POST);

  ?>
</body>

</html>