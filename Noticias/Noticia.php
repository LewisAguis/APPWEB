<!DOCTYPE html>
<html lang="es">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
 <link href="Noticias/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="Noticias/css/simple-sidebar.css" rel="stylesheet">
  

  <!-- Bootstrap core CSS -->
 
<?php
    $Id=$_REQUEST["Id"];
    echo $id;
    require_once "Conectar.php";
    $db = conectaDB();
   
    $result= consultaTodo($db,$Id);
        
        function consultaTodo($cons,$ide){
            $datos;        
            $consulta = "SELECT * FROM `Noticias` where id=$ide";
            $result = $cons->query($consulta);
            if (!$result) {
            } else {
                foreach ($result as $valor) {
                    $datos[]=$valor;
                }
            }
        return $datos;    
        }

     function consultaRec($cons){
        $data;        
        $consulta = "SELECT * FROM Noticias ORDER BY FECHA DESC";
        $result = $cons->query($consulta);
        if (!$result) {
        } else {
            foreach ($result as $valor) {
                $data[]=$valor;
            }
        }
    return $data;    
    }
    require_once "Conectar.php";
    $db = conectaDB();
    $rec=consultaRec($db) ; 
    
    print "<title>".$result[0]["NOMBRE"]."</title>";


?>
</head>

<body>

  <div class="d-flex" id="wrapper">

    <!-- Sidebar -->
    <div class="bg-light border-right" id="sidebar-wrapper">
      <div class="sidebar-heading">Noticias </div>
      <div class="list-group list-group-flush">
          <!-- Mostrar Recientes-->
        <?php
        for($i = 0; $i<6;$i++){
            $titu=$rec[$i]["NOMBRE"];
            $fec=$rec[$i]["FECHA"];
            $idR=$rec[$i]["Id"];
            print "<a href='Noticia.php?Id=$idR' class='list-group-item list-group-item-action bg-light'>$titu el <br> $fec</a>";        
        }
        
        
        ?>
        
      </div>
    </div>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">

      <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
        <button class="btn btn-primary" id="menu-toggle">Mostrar Recientes</button>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
            <li class="nav-item active">
              <a class="nav-link" href="PortalNoticias.php">Inicio <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="Login.php">Login</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Categorias
              </a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="PortalLocal.php">Local</a>
                <a class="dropdown-item" href="PortalDeportes.php">Deportes</a>
                <a class="dropdown-item" href="PortalTecnologia.php">Tecnologia</a>
              </div>
            </li>
          </ul>
        </div>
      </nav>

    <blockquote class="blockquote text-center">
        <?php
         require_once "Conectar.php";
        $db = conectaDB();
  
       
        
        $titulo=$result[0]["NOMBRE"];
        $autor=$result[0]["AUTOR"];
        $fecha=$result[0]["FECHA"];
        print "<p class='mb-0'>$titulo</p>";
        print "<footer class='blockquote-footer'> por $autor <cite title='$titulo'>el $fecha</cite></footer>";
    
        ?>
        </blockquote>
        
        <?php
         $imagen=$result[0]["Imagen"];
         $Url="Imagenes/";
         $dir=$Url.$imagen;
         $nota=$result[0]["Noticia"];
            print "<img src='$dir' class='img-fluid rounded' alt='$imagen'>";

            
            print "<div class='card-body'><p class='card-text'>$nota</p></div>";
            ?>
        </div>
    <?php 
    require_once "Conectar.php";
    $db = conectaDB();
       
    if($_REQUEST["Comentario"]!=NULL){
           function insertaComents($cons,$id,$comment){
            $consulta = "INSERT INTO `COMENTARIOS`(`idN`, `Comentario`) VALUES ($id,'$comment')";
            $result = $cons->query($consulta);
            if (!$result) {
            } else {
            }
            return $datos;    
        }
        
        $com=$_REQUEST["Comentario"];
        insertaComents($db,$Id,$com);
        
        
    }

   
    ?>
   
    <!-- /#page-content-wrapper -->
   

  </div>
  
  <?php 
   
        function consultaLikes($cons,$id){
            $datos;        
            $consulta = "SELECT `LIKES` FROM `Noticias` WHERE id=$id";
            $result = $cons->query($consulta);
            if (!$result) {
                print "    <p>Error en la consulta.</p>\n";
            } else {
                foreach ($result as $valor) {
                    $datos[]=$valor;
                }
            }
            return $datos;    
        }
        
        function aumentaLikes($cons,$id,$cant){
            $consulta = " UPDATE `Noticias` SET `LIKES`=$cant WHERE id=$id";
            $result = $cons->query($consulta);
            if (!$result) {
            } else {

            }
        }

      
            $like=consultaLikes($db,$Id);
            $like=$like[0]["LIKES"];

        if($_REQUEST["Like"]!=NULL){
            $like=$like+1;
            aumentaLikes($db,$Id,$like);
            
        }
  
  ?>
  
  <form  action="<?php echo $_SERVER['PHP_SELF']."?Id=$Id"; ?>" method="POST" enctype="multipart/form-data">
		<input type="hidden" name="Id" value="<?php echo $Id; ?>">
		<button type="submit" class="btn btn-primary" name="Like" value="1">Like<span class="badge"><?php echo $like; ?></button>
  </form>
  <!-- /#wrapper -->
  
    <?php 
        require_once "Conectar.php";
        $db = conectaDB();
        
        function consultaComents($cons,$id){
            $datos;        
            $consulta = "SELECT * FROM `COMENTARIOS` WHERE IdN=$id ORDER by IdC DESC";
            $result = $cons->query($consulta);
            if (!$result) {
                print "    <p>Error en la consulta.</p>\n";
            } else {
                foreach ($result as $valor) {
                    $datos[]=$valor;
                }
            }
            return $datos;    
        }
        
        $coments=ConsultaComents($db,$Id);
        
    
    ?>
    <ul class="list-group">
        <?php
        foreach ($coments as $valor) {
                print "<li class='list-group-item active'>".$valor["Comentario"]."</li>";

                }
        ?>
    </ul>
    
    
   <form  action="<?php echo $_SERVER['PHP_SELF']."?Id=$Id"; ?>" method="POST" enctype="multipart/form-data">
			<div class="form-group">
				<label for="exampleInputEmail1">Comentario:</label>
				<input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Escriba aqui su comentario" name="Comentario">
			    <input type="hidden" name="Id" value="<?php echo $Id; ?>">
			</div>
			<button type="submit" class="btn btn-primary">Comentar</button>
	</form>

  <!-- Bootstrap core JavaScript -->
  <script src="Noticias/js/jquery.min.js"></script>
  <script src="Noticias/js/bootstrap.bundle.min.js"></script>

  <!-- Menu Toggle Script -->
  <script>
    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });
  </script>

</body>

</html>