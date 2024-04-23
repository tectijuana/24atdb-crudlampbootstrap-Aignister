<?php
include "Conexion.php";
$id = $_GET["id"];
$sql = "DELETE FROM pan WHERE id = $id";
$result = mysqli_query($conn, $sql);

if ($result) {
  header("Location: Index.php?msg=Datos eliminados de manera exitosa");
  exit();
} else {
  echo "Error al registrar: " . mysqli_error($conn);
}
?>