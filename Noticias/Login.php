<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.5">
    <title>Login</title>

    <link href="Noticias/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">


    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    <link href="Noticias/css/floating-labels.css" rel="stylesheet">
 <ul class="nav  justify-content-center">
        <li class="nav-item">
            <a class="nav-link" href="PortalNoticias.php">Inicio</a>
        </li>
    </ul>
    </head>
    <body>
       
  
    <?php 
    if ($_SERVER['REQUEST_METHOD'] == 'GET') { ?>
        <form class="form-signin" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST"> 
            <div class="text-center mb-4">
                <img class="mb-4" src="Imagenes/login.jpg" alt="" width="72" height="72">
                <h1 class="h3 mb-3 font-weight-normal">Introduzca su correo y contraseña</h1>
            </div>

            <div class="form-label-group">
                <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus name="Correo">
                <label for="inputEmail">Direccion de Correo</label>
            </div>

            <div class="form-label-group">
                <input type="password" id="inputPassword" class="form-control" placeholder="Password" required name="Contra">
                <label for="inputPassword">Contraseña</label>
            </div>

            <button class="btn btn-lg btn-primary btn-block" type="submit">Ingresar</button>
        </form>
    
       
        <?php } else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
             
                require_once "Conectar.php";
                $db = conectaDB();
        
               
                function consultaUsuario($cons,$REC){
                    $us=$REC["Correo"];
                    $pass=$REC["Contra"];
                    $consulta = "SELECT * FROM Usuarios WHERE Correo='$us' and Contraseña='$pass'";
                    $result = $cons->query($consulta);
                   
                    $ult=$result->fetch(PDO::FETCH_NUM);
                    
                    
                    if ($ult==null) {
                        print "    <p>Error, Usuario o Contraseña incorrectos</p>\n";
                        $iable= $_SERVER['PHP_SELF'];
                        print "<a class='btn btn-primary' href='$iable' role='button'>Regresar</a>";
                        
                        
                        
                    } else {
                        
                        
                        
                         $db = null;
                        print "\n<p>Redirigiendo</p>\n";
                        echo "<script> window.location='Menu.php'; </script>";
                
                        }

                   
                }
               
               
               
                consultaUsuario($db,$_POST);
  
               
            } else {
                die("This script only works with GET and POST requests.");
        } ?>

    </body>
    
</html>