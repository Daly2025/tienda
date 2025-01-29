<?php
if (!isset($_POST["nombre"])) {
    header("Location: proveedores");
    exit();
}
include("conexiondb.php");
$sql = "INSERT INTO proveedores (nombre, web) VALUES (:nombre, :web)";
$stm = $conexion->prepare($sql);
$stm->bindParam(":nombre", $_POST["nombre"]);
$stm->bindParam(":web", $_POST["web"]);
$stm->execute();
$id=$conexion->lastInsertId();
header("Location: proveedores?id=$id");
?>