<?php
if (!isset($_GET["id"])) {
    header("Location: proveedores");
    exit();
}
include("partials/cabecera.php");
$sql = "SELECT P.id,P.nombre,P.web,D.id as iddireccion,D.calle,D.numero,D.comuna,D.ciudad
,T.id as idtelefono,T.numero as telefono FROM tienda.proveedores P 
left join tienda.direcciones D on P.id=D.proveedores_id
left join tienda.telefonos T on T.idproveedores=P.id
where P.id=:id;";
$stm = $conexion->prepare($sql);
$stm->bindParam(":id", $_GET["id"]);
$result = $stm->execute();

?>
<section>
    <?php
    $row = $stm->fetch(PDO::FETCH_ASSOC);
    echo "<p>" . $row["nombre"] . " " . $row["web"] . "</p>";
    if ($row["iddireccion"] != null) {
        echo "<p>" . $row["calle"] . " " . $row["numero"] . "</p>";
    }
    ;
    if ($row["idtelefono"] != null) {
        echo "<p>" . $row["telefono"] . "</p>";
    }
    ;
    $iddireccion_anterior = $row["iddireccion"];
    $idtelefono_anterior = $row["idtelefono"];
    while ($row = $stm->fetch(PDO::FETCH_ASSOC)) {
        if ($row["iddireccion"] != null & $row["iddireccion"]!=$iddireccion_anterior) {
            echo "<p>" . $row["calle"] . " " . $row["numero"] . "</p>";
        }
        ;
        if ($row["idtelefono"] != null & $row["idtelefono"]!=$idtelefono_anterior) {
            echo "<p>" . $row["telefono"] . "</p>";
        }
        ;
        $iddireccion_anterior = $row["iddireccion"];
        $idtelefono_anterior = $row["idtelefono"];
    }

    ?>
</section>
<?php
include("partials/footer.php");
?>