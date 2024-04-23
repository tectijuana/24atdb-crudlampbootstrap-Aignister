<?php
include "Conexion.php";

if(isset($_POST['Ingresar']))
{
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];

    $imagen_nombre = $_FILES['imagen']['name'];
    $imagen_ruta = 'uploads/' . $imagen_nombre;
    move_uploaded_file($_FILES['imagen']['tmp_name'], $imagen_ruta);

    if (!preg_match('/^[A-Za-z\s]+$/', $nombre)) {
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>El nombre no puede contener numeros</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    } else if (!preg_match('/^[A-Za-z\s]+$/', $descripcion)) {
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>La descripcion no puede contener numeros</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }
    else if ($nombre == '' && $precio == '' && $stock == '')
    {
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Falta ingresar uno de los siguientes campos, nombre, precio, stock</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }
    else
    {
        $sql = "INSERT INTO pan(nombre, descripcion, precio, stock, imagen) VALUES ('$nombre','$descripcion','$precio','$stock','$imagen_ruta')";
        $result = mysqli_query($conn, $sql);
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Datos ingresados de manera exitosa</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
    <link rel="icon" href="PerroMenso.png" type="png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name ="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ingresar</title>
    </head>
    <body>
        <div class="container">
            <div class="text-center mb-4">
                <h3>Registrar</h3>
                <p class="text-muted">Ingrese los datos</p>
            </div>
            <div class="container d-flex justify-content-center">
                <form action="" method="post" enctype="multipart/form-data" style="width: 50vw; min-width: 300px;">
                <div class="row mb-3">
                    <div class="mb-3">
                        <label class="form-label">Nombre:</label>
                        <input type="text" class="form-control" name="nombre" placeholder="Nombre">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Descripcion:</label>
                        <input type="text" class="form-control" name="descripcion" placeholder="Descripcion">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Precio:</label>
                        <input type="number" class="form-control" name="precio" placeholder="Precio">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Stock:</label>
                        <input type="number" class="form-control" name="stock" placeholder="Stock">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Imagen:</label>
                        <input type="file" class="form-control" name="imagen">
                    </div>
                </div>
                <div>
                    <button type="submit" class="btn btn-success" name="Ingresar">Ingresar</button>
                    <a href="Index.php" class="btn btn-danger">Cancelar</a>
                </div>
            </form>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
</html>