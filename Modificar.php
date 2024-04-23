<?php
include "Conexion.php";
$id = $_GET['id'];

if(isset($_POST["Modificar"]))
{
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];

    $imagen_nombre = $_FILES['imagen']['name'];
    $imagen_ruta = 'uploads/' . $imagen_nombre;

    if (!empty($imagen_ruta)) {
        $sql = "UPDATE pan SET nombre='$nombre', descripcion='$descripcion', precio='$precio', stock='$stock', imagen='$imagen_ruta' WHERE id=$id";
    } else {
        $sql = "UPDATE pan SET nombre='$nombre', descripcion='$descripcion', precio='$precio', stock='$stock' WHERE id=$id";
    }

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
        <strong>Falta ingresar el nombre, precio y el stock</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }
    else
    {
        
        if (!empty($imagen_contenido)) {
            
            $sql = "UPDATE pan SET nombre='$nombre', descripcion='$descripcion', precio='$precio', stock='$stock', imagen='$imagen_contenido' WHERE id=$id";
        } else {
            
            $sql = "UPDATE pan SET nombre='$nombre', descripcion='$descripcion', precio='$precio', stock='$stock' WHERE id=$id";
        }

        $result = mysqli_query($conn, $sql);
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Se han modificado los datos correctamente</strong>
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
        <title>Modificar</title>
    </head>
    <body>
        <div class="text-center mb-4">
            <h3>Editar Informacion</h3>
            <p class="text-muted">Ingresar los nuevos datos</p>
        </div>
        <?php
        $sql = "SELECT * FROM pan WHERE id = $id LIMIT 1";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        ?>
        <div class="container d-flex justify-content-center">
            <form action="" method="post" enctype="multipart/form-data" style="width:50vw; min-width:300px;">
            <div class="row mb-3">
                <div class="mb-3">
                    <label class="form-label">Nombre</label>
                    <input type="text" class="form-control" name="nombre" value="<?php echo $row['nombre']?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Descripcion</label>
                    <input type="text" class="form-control" name="descripcion" value="<?php echo $row['descripcion']?>">
                </div>
                <div class="mb-3">
                    <label class="form-lable">Precio</label>
                    <input type="number" class="form-control" name="precio" value="<?php echo $row['precio']?>">
                </div>
                <div class="mb-3">
                    <label class="form-lable">Stock</label>
                    <input type="number" class="form-control" name="stock" value="<?php echo $row['stock']?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Imagen:</label>
                    <input type="file" class="form-control" name="imagen">
                </div>
                <div>
                    <button type="submit" class="btn btn-success" name="Modificar">Modificar</button>
                    <a href="Index.php" class="btn btn-danger">Cancelar</a>
                </div>
            </div>           
            </div>
        </form>
        </div> 
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
</html>