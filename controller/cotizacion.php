<?php

require_once "../conexion/conn.php";

$json = file_get_contents("php://input");

$object = json_decode($json);
$idUsuario = $object->idUsuario;
$idsCatalogo = $object->catalogo;

$db = database::conectar();

$statement = $db->prepare("INSERT INTO catalogo_has_usuarios(usuarios_id, catalogo_id) VALUES(:idUsuario, :idCatalogo)");

for ($i = 0; $i < count($idsCatalogo); $i++) {
    $result = $statement->execute(array(
        ':idUsuario' => $idUsuario,
        ':idCatalogo' => $idsCatalogo[$i]
    ));
}

echo json_encode(['mensaje' => "Datos guardados con exito"]);
exit()

?>