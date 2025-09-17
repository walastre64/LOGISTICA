<?PHP
header("Content-Type: text/html;charset=utf-8");
setlocale(LC_TIME, 'es_VE');
date_default_timezone_set('America/Caracas');
include("../conexion/conexionsqlsrv.php");
include("../validacion/validacion_general2.php");
//include ('../restringir/restringir.ini.php');
$conn = conectate();

// ------------------------------------------------->

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel='shortcut icon' type='image/x-icon' href="../imagenes/ICO/ipsfa.ico"/>

    <title>SIGESP-SAINT</title>

    <!-- Bootstrap core CSS -->
	<!-- JQUERY -->
	<script src="../jquery/jquery-3.3.1.min.js"></script>
    <!-- Bootstrap CSS -->
    <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">-->
	<!--<link rel="stylesheet" href="../bootstrap/dist/awesome/css/font-awesome.min.css" 	crossorigin="anonymous">	     -->
	
	<!-- FIM Bootstrap CSS -->			
    <link href="../bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles -->
    <link href="../bootstrap/dist/css/dashboard.css" rel="stylesheet">
	<link rel="stylesheet" href="../bootstrap/dist/toastr/toastr.min.css"  				crossorigin="anonymous">	
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

  </head>
<style>
     @media screen and (max-width: 800px){
            #cell-sidebar {
                flex-basis: 52px;
            }
            #cell-content {
                flex-basis: calc(100% - 52px);
            }		
	}
	
	@media all and (max-width: 800px){
		div{
			width:100%;
			height:auto;
			margin-left:10px;
		 }
	}

.divider-vertical {
	/*height: 50px;*/
	margin: 0 9px;
	border-left: 1px solid #F2F2F2;
	border-right: 1px solid #FFF;
}

#menu_horizontal li {
	margin-left: 25px;
	padding: 0px;
}

#li_menu div{
	font-size:12px
}

#main1 {    
	height: 800px;
	border: 0;	
	overflow-y:hidden;
	overflow-x:hidden;
}
#contenedor{
	overflow-y:hidden;
	overflow-x:hidden;
}
</style>
 <body>
	
    <nav class="navbar navbar-dark sticky-top bg-success navbar-expand-lg flex-md-nowrap p-0">
      <a class="navbar-brand col-sm-6 col-md-2 mr-0" href="#"><b>SIGESP-SAINT</b></a>

     <ul id="menu_horizontal" class="navbar-nav mr-auto mt-6 mt-lg-0">
       
	    <li class="nav-item ">
		  <i class="fa-camera-retro"></i>
          <a class="nav-link" href="#">menu 1</a>
        </li>

        <li class="nav-item text-nowrap">
          <a class="nav-link" href="#">menu2</a>
        </li>	
			
        <li class="nav-item text-nowrap">
          <a class="nav-link" href="#">menu3</a>
        </li>	  
     
        <li class="nav-item text-nowrap">
          <a class="nav-link" href="#">menu4</a>
        </li>	
		
      </ul>


      <ul class="navbar-nav px-2">
		  
		  <li id="li_menu"  class="nav-item dropdown align-content-between">
			<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Usuario</a>
			<div  class="dropdown-menu">
			  <a class="dropdown-item" href="#">Cambiar Clave</a>
			  <a class="dropdown-item" href="#">Another action</a>
			  <a class="dropdown-item" href="#">Something else here</a>
			  <div class="dropdown-divider"></div>
			  <a class="dropdown-item" href="#">Separated link</a>
			</div>
		  </li>	     
	 
	    <li class="nav-item text-nowrap">
          <a class="nav-link" href="../index.php">Desconectar</a>
        </li>
      </ul>

    </nav>

    <div id="x1" class="container-fluid">
      <div id="x2" class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
          <div id="x3" class="sidebar-sticky">
            <ul class="nav flex-column">
              <li class="nav-item">
                <a id="mnu" class="nav-link active" href="#">
                  <span data-feather="home"></span>
                  Menu <span class="sr-only">(current)</span>
                </a>
              </li>
              <li class="nav-item">
                <a id="mnu_crea" class="nav-link" href="#">
                  <span data-feather="file"></span>
                  Orders
                </a>
              </li>
              <li class="nav-item">
                <a id="mnu_otra" class="nav-link" href="#">
                  <span data-feather="shopping-cart"></span>
                  Products
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">
                  <span data-feather="users"></span>
                  Customers
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">
                  <span data-feather="bar-chart-2"></span>
                  Reports
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">
                  <span data-feather="layers"></span>
                  Integrations
                </a>
              </li>
            </ul>

            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
              <span>Saved reports</span>
              <a class="d-flex align-items-center text-muted" href="#">
                <span data-feather="plus-circle"></span>
              </a>
            </h6>
            <ul class="nav flex-column mb-2">
              <li class="nav-item">
                <a class="nav-link" href="#">
                  <span data-feather="file-text"></span>
                  Current month
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">
                  <span data-feather="file-text"></span>
                  Last quarter
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">
                  <span data-feather="file-text"></span>
                  Social engagement
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">
                  <span data-feather="file-text"></span>
                  Year-end sale
                </a>
              </li>
            </ul>
          </div>
        </nav>

				
		<main style="background-image: url(../imagenes/png/saint_sigesp.png);" id="main1" role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4"  >
			<div id="contenedor">							
			</div>	
		</main>
			
	  </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    
	
    <script>window.jQuery || document.write('<script src="../bootstrap/assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="../bootstrap/assets/js/vendor/popper.min.js"></script>
    <script src="../bootstrap/dist/js/bootstrap.min.js"></script>
	<script src="../bootstrap/dist/toastr/toastr.min.js"></script>

    <!-- Icons -->
    <script src="../bootstrap/dist/js/feather.min.js"></script>
    <script>
      feather.replace()
    </script>

    <!-- Graphs -->
    <script src="../bootstrap/dist/js/Chart.min.js"></script>
	<!-- aqui hace el llamado -->	
	<script type="text/javascript">
$(document).ready(function(){

	$('#mnu').on('click', function(){				
		$("#contenedor").empty();
		$(".nav-link").removeClass("active");
		$('#mnu').last().addClass("active");		
	});



	$('#mnu_crea').on('click', function(){				
		$("#contenedor").empty();
		$('#contenedor').load('../paginas/issg_base_datos.php');
		$(".nav-link").removeClass("active");
		$('#mnu_crea').last().addClass("active");
		
	});
	
	$('#mnu_otra').on('click', function(){				
		$("#contenedor").empty();
		$('#contenedor').load('../paginas/untitled1.php');
		$(".nav-link").removeClass("active");
		$('#mnu_otra').last().addClass("active");
		
	});	
	
});
</script>	
	
  </body>
</html>