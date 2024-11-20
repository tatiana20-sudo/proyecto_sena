<!DOCTYPE html>
<html lang="es">

<head>
  <link rel="stylesheet" type="text/css" href="../css/cruds.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta charset="utf-8">
  <title>Registrando Catalogo</title>
</head>

<body>

  <p>Estamos registrando el catalogo</p>

  <?php

  session_start();

  require_once "../conexion/conn.php";

  if (!isset($_POST["nombre"]) && !isset($_FILES["imagen"])) {
    header("Location: ../views/admin.php?mensaje_error=Debes ingresar un nombre y seleccionar una imagen");
    die();
  }

  if (isset($_POST["nombre"]) && isset($_FILES["imagen"])) {

    $target_dir = "../uploads/";
    $target_file = $target_dir . base64_encode(openssl_random_pseudo_bytes(10)) . basename($_FILES["imagen"]["name"]);
    $uploadOk = 1;

    $check = getimagesize($_FILES["imagen"]["tmp_name"]);
    if ($check !== false) {
      $uploadOk = 1;
    } else {
      $uploadOk = 0;
    }

    if (file_exists($target_file)) {
      $uploadOk = 0;
    }

    if ($uploadOk == 0) {
      header("Location: ../views/admin.php?mensaje_error=No se pudo subir el archivo, intentalo de nuevo");
      die();
    } else {
      if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $target_file)) {

        $db = database::conectar();

        $statement = $db->prepare("INSERT INTO catalogo(nombre, imagen, usuarios_id) VALUES(:nombre, :imagen, :usuario_id)");
        $result = $statement->execute(array(
          ':nombre' => $_POST["nombre"],
          ':imagen' => $target_file,
          ":usuario_id" => $_SESSION["id"]
        ));

        if (!$result) {
          header("Location: ../views/admin.php?mensaje_error=No se pudo crear el catalogo, por favor intentalo de nuevo");
          die();
        }

        header("Location: ../views/admin.php?mensaje=Catalogo creado con exito");
        die();
      } else {
        header("Location: ../views/admin.php?mensaje_error=No se pudo subir el archivo, intentalo de nuevo");
        die();
      }
    }
  }
  ?>