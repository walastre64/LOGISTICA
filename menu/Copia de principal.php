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
	<link rel="stylesheet" href="../bootstrap/dist/awesome/css/font-awesome.min.css" 	crossorigin="anonymous">	
	<link rel="stylesheet" href="../bootstrap/dist/toastr/toastr.min.css"  				crossorigin="anonymous">
	<!-- FIM Bootstrap CSS -->		
	
    <link href="../bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles -->
    <link href="../bootstrap/dist/css/dashboard.css" rel="stylesheet">
  </head>
<style>

nav.navbar {
    background-color:#FF0066;
}

</style>
 <body>
    <nav class="navbar navbar-dark sticky-top  flex-md-nowrap p-0">
      <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">SIGESP-SAINT</a>
      <!--<input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search"> -->
      <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
          <a class="nav-link" href="../index.php">Desconectar</a>
        </li>
      </ul>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
          <div class="sidebar-sticky">
            <ul class="nav flex-column">
              <li class="nav-item">
                <a class="nav-link active" href="#">
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

	<!-- aqui -->
			
        		<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
					<div id="contenedor">
     				
					</div><!-- fin aqui -->		
	    		</main>

			
	  </div>
    </div>
	
	

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    
	
    <script>window.jQuery || document.write('<script src="../bootstrap/assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="../bootstrap/assets/js/vendor/popper.min.js"></script>
    <script src="../bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Icons -->
    <script src="../bootstrap/dist/js/feather.min.js"></script>
    <script>
      feather.replace()
    </script>

    <!-- Graphs -->
    <script src="../bootstrap/dist/js/Chart.min.js"></script>
    <script>
      var ctx = document.getElementById("myChart");
      var myChart = new Chart(ctx, {
        type: 'line',
        data: {
          labels: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
          datasets: [{
            data: [15339, 21345, 18483, 24003, 23489, 24092, 12034],
            lineTension: 0,
            backgroundColor: 'transparent',
            borderColor: '#007bff',
            borderWidth: 4,
            pointBackgroundColor: '#007bff'
          }]
        },
        options: {
          scales: {
            yAxes: [{
              ticks: {
                beginAtZero: false
              }
            }]
          },
          legend: {
            display: false,
          }
        }
      });
    </script>
	
	<!-- aqui hace el llamado -->	
	<script type="text/javascript">
$(document).ready(function(){

	$('#mnu_crea').on('click', function(){				
		$("#contenedor").empty();
		$('#contenedor').load('../paginas/ventas_carrera.php');
	});
	
	$('#mnu_otra').on('click', function(){				
		$("#contenedor").empty();
		$('#contenedor').load('../paginas/untitled.php');
	});	
	
});

	

</script>	
	
  </body>
</html>