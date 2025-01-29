<?php
include("partials/cabecera.php");

// Consulta para obtener las categorías
$sql = "SELECT * FROM categorias ORDER BY id DESC";
$result = $conexion->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nueva Categoría</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
<div class="contacto">
    <div>
        <h3>NUEVA CATEGORIA</h3>
        <form action="nueva_categoria.php" method="post">
            <input type="hidden" name="idcategoria" value="<?php echo isset($_GET['id']) ? htmlspecialchars($_GET['id']) : ''; ?>">
            <label for="nombre_categoria">Nombre de categoría</label>
            <input type="text" name="nombre_categoria" id="nombre_categoria" required placeholder="Nombre de categoría">
            <label for="descripcion">Descripción</label>
            <textarea name="descripcion" id="descripcion" required placeholder="Descripción"></textarea>
            <input type="submit" value="Guardar">
            <input type="reset" value="Cancelar">
        </form>
    </div>

    
    <?php if ($result->rowCount() > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($categoria = $result->fetch(PDO::FETCH_ASSOC)): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($categoria['nombre']); ?></td>
                        <td><?php echo htmlspecialchars($categoria['descripcion']); ?></td>
                        <td>
                            <!-- Puedes agregar enlaces para editar o eliminar si lo deseas -->
                            <a href="editar_categoria.php?id=<?php echo $categoria['id']; ?>">Editar</a> |
                            <a href="eliminar_categoria.php?id=<?php echo $categoria['id']; ?>">Eliminar</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No hay categorías registradas.</p>
    <?php endif; ?>
</div>
</body>
</html>

<?php
include("partials/footer.php");
?>



