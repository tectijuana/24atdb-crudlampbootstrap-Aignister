<?php
include "Conexion.php";

// Metodo para buscar elementos de la tabla

if(isset($_POST['Buscar']))
{
    $nombre = $_POST['nombre'];
    $sql= "SELECT * FROM pan WHERE nombre LIKE '$nombre%'";
    $result = mysqli_query($conn, $sql);
    if($nombre == '') 
    {
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>No se encontraron datos</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }
    else if(mysqli_num_rows($result) == 0)
    {
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>No se encontraron datos</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }
} 
else if (isset($_POST['Regresar']))
{
    $sql = "SELECT * FROM pan";
    $result = mysqli_query($conn, $sql);
}

?>
        
<!DOCTYPE html>
<html>
    <head>
        
        <!-- Enlaces referentes a iconos y bootstrap, asi como los meta necesarios -->
        
    <link rel="icon" href="PerroMenso.png" type="png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer"/>        
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Tabla</title>
        
        <!-- Style para mantener el footer siempre abajo -->
    
        <style>
            html, body {
                height: 100%;
                margin: 0;
                display: flex;
                flex-direction: column;
                background-color: #f0f0f0;
            }

            .container {
                flex: 1 0 auto;
            }

            footer {
                flex-shrink: 0;
            }
            
            .table-container {
                background-color: #fff; 
                padding: 20px; 
                margin: 0 auto; 
                max-width: 1200px; 
            }
            
        </style>
    </head>
    <body>
        
        <!-- Navbar como header de la interfaz -->
        
        <nav class="navbar navbar-expand-lg bg-dark">
            <div class="container-fluid text-center">
                <ul class="navbar-nav mb-2 mb-lg-0" style="margin-left: 300px;">
                    <form method="post">
                        <div class="d-grid.col-6 d-flex">
                            <input type="text" class="form-control mb-3" name="nombre" placeholder="Nombre" style="width: 200px; margin-right: 10px">
                            <button type="Submit"class="btn btn-success mb-3" style="margin-right: 10px" name="Buscar">Buscar</button>
                            <button type="Submit"class="btn btn-success mb-3" style="margin-right: 800px" name="Regresar">Regresar</button>
                            <a href="Ingresar.php" class="btn btn-success mb-3">Ingresar</a>
                        </div>
                    </form> 
                </ul>
            </div>
        </nav>
        <div class="container">
            <div class="table-container">
            
            <!-- Mensaje de eliminacion de datos -->
            
            <?php
            if(isset($_GET["msg"]))
            {
                $msg = $_GET["msg"];
                echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>' . $msg . '</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
            }
            ?>
            <p></p>
            
            <!-- Mostrar las tablas, asi como el actualizar la tabla cuando se busca -->
            
            <table class="table table-hover text-center">
                <thead class="table-dark">
                    <tr>
                        <th scope ="col">Num_Control</th>
                        <th scope ="col">Nombre</th>
                        <th scope ="col">Descripcion</th>
                        <th scope ="col">Precio</th>
                        <th scope ="col">Stock</th>
                        <th scope ="col">Imagen</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                     $sql = "SELECT * FROM pan";
                     if(isset($result)) {
                     while ($row = mysqli_fetch_assoc($result))
                     {
                    ?>
                    <tr>
                        <td><?php echo $row["id"] ?></td>
                        <td><?php echo $row["nombre"] ?></td>
                        <td><?php echo $row["descripcion"] ?></td>
                        <td><?php echo $row["precio"] ?></td>
                        <td><?php echo $row["stock"] ?></td>
                        <td><img src="<?php echo $row['imagen']; ?>" alt="imagen" style="width:100px;height:100px;"></td>
                        <td>
                            <a href="Modificar.php?id=<?php echo $row["id"] ?>" class="link-dark"><i class="fa-solid fa-pen-to-square fs-5 me-3"></i></a>
                            <a href="Eliminar.php?id=<?php echo $row["id"] ?>" class="link-dark" onclick="return confirm('Seguro?')"><i class="fa-solid fa-trash fs-5"></i></a>
                        </td>
                    </tr>
                    <?php
                     }
                    } 
                    else 
                    {
                        $result = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                        <td><?php echo $row["id"] ?></td>
                        <td><?php echo $row["nombre"] ?></td>
                        <td><?php echo $row["descripcion"] ?></td>
                        <td><?php echo $row["precio"] ?></td>
                        <td><?php echo $row["stock"] ?></td>
                        <td><img src="<?php echo $row['imagen']; ?>" alt="imagen" style="width:100px;height:100px;"></td>
                        <td>
                            <a href="Modificar.php?id=<?php echo $row["id"] ?>" class="link-dark"><i class="fa-solid fa-pen-to-square fs-5 me-3"></i></a>
                            <a href="Eliminar.php?id=<?php echo $row["id"] ?>" class="link-dark"><i class="fa-solid fa-trash fs-5"></i></a>
                        </td>
                    </tr>
                    <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
        
        <!-- Footer con datos -->
        
        <footer class="bg-dark text-center text-white py-3">
            <div class="container text-center text-white">
                <p>&copy; Torres Murillo Luis Enrique</p>
                <p>Ejemlpo de CRUD con bootstrap</p>
                <p></p>
            </div>
        </footer>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    </body>
</html>
