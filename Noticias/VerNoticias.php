<!DOCTYPE html>
<html>
<head>
	<title>Todas las noticias</title>
	<link rel="stylesheet" type="text/css" href="Noticias/css/bootstrap.css">
    <ul class="nav  justify-content-center">
        
        <li class="nav-item">
            <a class="nav-link " href="Menu.php">Regresar a menu</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="PortalNoticias.php">Inicio</a>
        </li>
    </ul>
</head>
<body>
       <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  
  
<div class="d-flex" id="wrapper">

    <!-- Sidebar -->
    <div class="bg-light border-right" id="sidebar-wrapper">
      <div class="sidebar-heading">Otras opciones </div>
      <div class="list-group list-group-flush">
        <a href="ValidarNoticias.php" class="list-group-item list-group-item-action bg-light">Nueva Noticia</a>
        <a href="ActualizarNoticia.php" class="list-group-item list-group-item-action bg-light">Modificar Noticia</a>
        <a href="Eliminar.php" class="list-group-item list-group-item-action bg-light">Eliminar Noticia</a>
      </div>
    </div>
    <!-- /#sidebar-wrapper -->

  
  
   <?php
        require_once "Conectar.php";
        $db = conectaDB();
       
      
        $datos;
        $consulta = "SELECT * FROM Noticias";
        $result = $db->query($consulta);
        if (!$result) {
            print "    <p>Error en la consulta.</p>\n";
        } else {
            foreach ($result as $valor) {
                $datos[]=$valor;
            }
        }

        $db = null;
   
        
    $filas= sizeof($datos);
    
    ?>
    

    <table class="table table-dark">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Nombre</th>
                <th scope="col">Categoria</th>
                <th scope="col">Autor</th>
                <th scope="col">Fecha</th>
                <th scope="col">Ver</th>
                <th scope="col">Likes</th>
                <th scope="col">Descripcion</th>
            </tr>
        </thead>
        <tbody>
            <?php
            
            
            for ($i = 0; $i < $filas; $i++) {
                $id=$datos[$i]["Id"];
                $nom=$datos[$i]["NOMBRE"];
                $cat=$datos[$i]["Categoria"];
                $Aut=$datos[$i]["AUTOR"];
                $fech=$datos[$i]["FECHA"];
                $lik=$datos[$i]["LIKES"];
                $des=$datos[$i]["Description"];
                $ver="Noticia.php?Id=$id";
               
               print "<tr><th scope='row'>$id</th><td>$nom</td><td>$cat</td><td>$Aut</td><td>$fech</td><td><a href='$ver'>Ver</a></td><td>$lik</td><td>$des</td></tr>";
            }
            
           
            ?>
</table>

</div>
</body>
</html>