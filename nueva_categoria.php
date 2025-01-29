<?php
if (!isset($_POST["nombre_categoria"])) {
    header("Location: categorias");
    exit();
}

include("conexiondb.php");

try {
    // Establecer el modo de error de PDO para que se muestren los errores
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Validación de datos recibidos
    if (empty($_POST["nombre_categoria"]) || empty($_POST["descripcion"])) {
        echo "Faltan datos necesarios.";
        exit();
    }
    
    // Preparar la consulta SQL
    $sql = "INSERT INTO categorias (nombre, descripcion) VALUES (:nombre, :descripcion)";
    $stm = $conexion->prepare($sql);

    // Vincular los parámetros
    $stm->bindParam(":nombre", $_POST["nombre_categoria"]);
    $stm->bindParam(":descripcion", $_POST["descripcion"]);

    // Ejecutar la consulta
    $stm->execute();

    // Confirmar si los datos se insertaron correctamente (opcional)
    echo "Datos insertados correctamente: " . $_POST["nombre_categoria"] . " - " . $_POST["descripcion"];

    // Redirigir a la página de categorías (esto puede ser comentado temporalmente para depurar)
    header("Location: categorias");
    exit(); 
    
} catch (PDOException $e) {
    // Muestra el error si algo falla
    echo "Error en la inserción: " . $e->getMessage();
}
?>
