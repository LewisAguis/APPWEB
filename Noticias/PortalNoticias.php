<!DOCTYPE html>
<html lang="es">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Portal Noticias</title>

  <!-- Bootstrap core CSS -->
  <link href="Noticias/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="Noticias/css/simple-sidebar.css" rel="stylesheet">
<?php
    require_once "Conectar.php";
    $db = conectaDB();
    $result= consultaTodo($db);
    function consultaTodo($cons){
        $datos;        
        $consulta = "SELECT * FROM `Noticias` ORDER BY LIKES DESC";
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

     function consultaRec($cons){
        $data;        
        $consulta = "SELECT * FROM Noticias ORDER BY FECHA DESC";
        $result = $cons->query($consulta);
        if (!$result) {
            print "    <p>Error en la consulta.</p>\n";
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
               <a class="navbar-brand" href="#"><img style="width: 70px;" src="Imagenes/logo.png" alt="TopoNoticias">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
               <li class="nav-item">
                <p>Topo Noticias</p>
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

    <div class="container-fluid">
     <div class="container-fluid">
  <div class="table-responsive">
  <table class="table table-borderless">
   <tbody>
      <tr>
          <td>
            <?php
                $URL=$result[0]["URL"];
                $img=$URL."/".$result[0]["Imagen"];
                $Nombre=$result[0]["NOMBRE"];
                $Categoria=$result[0]["Categoria"];
                $Desc=$result[0]["Description"];
                $idn=$result[0]["Id"];
                $cad="<div class='card' style='width: 18rem;'>
                    <img src='$img' class='card-img-top' >
                    <div class='card-body'>
                        <h5 class='card-title'>$Nombre</h5>
                        <p class='card-text'>$Desc</p>
                        <a href='Noticia.php?Id=$idn' class='btn btn-primary'>Ir a Nota</a>
                        <div class='badge badge-primary text-wrap' style='width: 6rem;'>$Categoria</div>
                    </div>
                </div>";
            
        
          print "$cad";      
         
              ?>
          </td>

        <td>
          <?php
                  $URL=$result[1]["URL"];
                $img=$URL."/".$result[1]["Imagen"];
                $Nombre=$result[1]["NOMBRE"];
                $Categoria=$result[1]["Categoria"];
                $Desc=$result[1]["Description"];
                $idn=$result[1]["Id"];
                $cad="<div class='card' style='width: 18rem;'>
                    <img src='$img' class='card-img-top' >
                    <div class='card-body'>
                        <h5 class='card-title'>$Nombre</h5>
                        <p class='card-text'>$Desc</p>
                        <a href='Noticia.php?Id=$idn' class='btn btn-primary'>Ir a Nota</a>
                        <div class='badge badge-primary text-wrap' style='width: 6rem;'>$Categoria</div>
                    </div>
                </div>";
            
        
          print "$cad";      
         
              ?>
        </td>
        
        <td>
           <?php
                $URL=$result[2]["URL"];
                $img=$URL."/".$result[2]["Imagen"];
                $Nombre=$result[2]["NOMBRE"];
                $Categoria=$result[2]["Categoria"];
                $Desc=$result[2]["Description"];
                $idn=$result[2]["Id"];
                $cad="<div class='card' style='width: 18rem;'>
                    <img src='$img' class='card-img-top' >
                    <div class='card-body'>
                        <h5 class='card-title'>$Nombre</h5>
                        <p class='card-text'>$Desc</p>
                        <a href='Noticia.php?Id=$idn' class='btn btn-primary'>Ir a Nota</a>
                        <div class='badge badge-primary text-wrap' style='width: 6rem;'>$Categoria</div>
                    </div>
                </div>";
            
        
          print "$cad";      
         
         
              ?>
        </td>

      </tr>
      <tr>
        <td>  
        <?php
                $URL=$result[3]["URL"];
                $img=$URL."/".$result[3]["Imagen"];
                $Nombre=$result[3]["NOMBRE"];
                $Categoria=$result[3]["Categoria"];
                $Desc=$result[3]["Description"];
                $idn=$result[3]["Id"];
                $cad="<div class='card' style='width: 18rem;'>
                    <img src='$img' class='card-img-top' >
                    <div class='card-body'>
                        <h5 class='card-title'>$Nombre</h5>
                        <p class='card-text'>$Desc</p>
                        <a href='Noticia.php?Id=$idn' class='btn btn-primary'>Ir a Nota</a>
                        <div class='badge badge-primary text-wrap' style='width: 6rem;'>$Categoria</div>
                    </div>
                </div>";
            
        
          print "$cad";      
         
              ?>
        </td>

        <td>
       <?php
                  $URL=$result[4]["URL"];
                $img=$URL."/".$result[4]["Imagen"];
                $Nombre=$result[4]["NOMBRE"];
                $Categoria=$result[4]["Categoria"];
                $Desc=$result[4]["Description"];
                $idn=$result[4]["Id"];
                $cad="<div class='card' style='width: 18rem;'>
                    <img src='$img' class='card-img-top' >
                    <div class='card-body'>
                        <h5 class='card-title'>$Nombre</h5>
                        <p class='card-text'>$Desc</p>
                        <a href='Noticia.php?Id=$idn' class='btn btn-primary'>Ir a Nota</a>
                        <div class='badge badge-primary text-wrap' style='width: 6rem;'>$Categoria</div>
                    </div>
                </div>";
            
        
          print "$cad";      
         
              ?>
        </td>
        
        <td>
      <?php
                 $URL=$result[5]["URL"];
                $img=$URL."/".$result[5]["Imagen"];
                $Nombre=$result[5]["NOMBRE"];
                $Categoria=$result[5]["Categoria"];
                $Desc=$result[5]["Description"];
                $idn=$result[5]["Id"];
                $cad="<div class='card' style='width: 18rem;'>
                    <img src='$img' class='card-img-top' >
                    <div class='card-body'>
                        <h5 class='card-title'>$Nombre</h5>
                        <p class='card-text'>$Desc</p>
                        <a href='Noticia.php?Id=$idn' class='btn btn-primary'>Ir a Nota</a>
                        <div class='badge badge-primary text-wrap' style='width: 6rem;'>$Categoria</div>
                    </div>
                </div>";
            
        
          print "$cad";      
         
              ?>
        </div>
        </td>
      </tr>
      <tr>
        <td>   
        <?php  $URL=$result[6]["URL"];
                $img=$URL."/".$result[6]["Imagen"];
                $Nombre=$result[6]["NOMBRE"];
                $Categoria=$result[6]["Categoria"];
                $Desc=$result[6]["Description"];
                $idn=$result[6]["Id"];
                $cad="<div class='card' style='width: 18rem;'>
                    <img src='$img' class='card-img-top' >
                    <div class='card-body'>
                        <h5 class='card-title'>$Nombre</h5>
                        <p class='card-text'>$Desc</p>
                        <a href='Noticia.php?Id=$idn' class='btn btn-primary'>Ir a Nota</a>
                        <div class='badge badge-primary text-wrap' style='width: 6rem;'>$Categoria</div>
                    </div>
                </div>";
            
        
          print "$cad";      
         
         
              ?>
        </td>

        <td>
        <?php
                 $URL=$result[7]["URL"];
                $img=$URL."/".$result[7]["Imagen"];
                $Nombre=$result[7]["NOMBRE"];
                $Categoria=$result[7]["Categoria"];
                $Desc=$result[7]["Description"];
                $idn=$result[7]["Id"];
                $cad="<div class='card' style='width: 18rem;'>
                    <img src='$img' class='card-img-top' >
                    <div class='card-body'>
                        <h5 class='card-title'>$Nombre</h5>
                        <p class='card-text'>$Desc</p>
                        <a href='Noticia.php?Id=$idn' class='btn btn-primary'>Ir a Nota</a>
                        <div class='badge badge-primary text-wrap' style='width: 6rem;'>$Categoria</div>
                    </div>
                </div>";
            
        
          print "$cad";      
         
              ?>
        </td>
        
        <td>
         <?php  $URL=$result[8]["URL"];
                $img=$URL."/".$result[8]["Imagen"];
                $Nombre=$result[8]["NOMBRE"];
                $Categoria=$result[8]["Categoria"];
                $Desc=$result[8]["Description"];
                $idn=$result[8]["Id"];
                $cad="<div class='card' style='width: 18rem;'>
                    <img src='$img' class='card-img-top' >
                    <div class='card-body'>
                        <h5 class='card-title'>$Nombre</h5>
                        <p class='card-text'>$Desc</p>
                        <a href='Noticia.php?Id=$idn' class='btn btn-primary'>Ir a Nota</a>
                        <div class='badge badge-primary text-wrap' style='width: 6rem;'>$Categoria</div>
                    </div>
                </div>";
            
        
          print "$cad";      
         
         
              ?>
        </td>
        
        
      </tr>
    </tbody>
  </table>
</div>
    
    </div>
    </div>
    <!-- /#page-content-wrapper -->

  </div>
  <!-- /#wrapper -->

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

