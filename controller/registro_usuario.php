<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Creando Usuario</title>
</head>

<body>
  <p>Estamos creando tu usuario, por favor espera un segundo.</p>

  <?php

  class RegistroController
  {

    public function registrarUsuario($datos)
    {
      session_start();

      require_once '../conexion/conn.php';

      $db = database::conectar();

      $statement = $db->prepare("INSERT INTO usuarios(nombre, email, clave, cedula, direccion, telefono, rol) VALUES(:nombre, :email, :clave, :cedula, :direccion, :telefono, :rol)");
      $result = $statement->execute(array(
        ':nombre' => $datos["nombre"],
        ':email' => $datos["email"],
        ':clave' => password_hash($datos["clave"], PASSWORD_DEFAULT),
        ':cedula' => $datos["cedula"],
        ':direccion' => $datos["direccion"],
        ':telefono' => $datos["telefono"],
        ':rol' => "usuario",
      ));

      if (!$result) {
        $_SESSION['active'] = 0;

        header("Location: ../views/registrarse.php?mensaje_error=Ocurrio un error al crear tu usuario");
        die();
      }

      $_SESSION['active'] = 1;
      $_SESSION['rol'] = "usuario";

      header("Location: ../views/usuario.php?mensaje=Tu cuenta se creo con exito");
      die();
    }
  }

  $registroController = new RegistroController();
  $registroController->registrarUsuario($_POST);

  ?>
</body>

</html>