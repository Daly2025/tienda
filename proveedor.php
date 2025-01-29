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
    $direccions=[];
    $telefonos=[];
    $row=$stm->fetch(PDO::FETCH_ASSOC);
    if($row) {
        echo "<div class='proveedor'>
        <h1>Proveedor</h1>
        <h4>{$row['nombre']}</h4>
        <p>Web: <a href='{$row['web']}'>{$row['web']}</a></p>
        </div>";
    }
    ?>


</section>
<?php
include("partials/footer.php");
?>