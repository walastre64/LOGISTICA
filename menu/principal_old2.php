	<?PHP
header("Content-Type: text/html;charset=utf-8");
setlocale(LC_TIME, 'es_VE');
date_default_timezone_set('America/Caracas');
include("../conexion/conexionsqlsrv.php");
include("../validacion/validacion_general2.php");
$conn = conectate();
session_start();
// ------------------------------------------------->
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
	<link rel="shortcut icon" href="imagenes/favicon.ico" type="image/x-ico"/>
	<link rel="stylesheet" type="text/css" href="../css/principal.css">


    <title>Logística - Menu</title>

    <!-- Bootstrap core CSS -->
	<!-- JQUERY -->
	  <script type="text/javascript" src="../validacion/validacion_general.js"></script>
      <link href="../bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">          
      <link href="../bootstrap/dist/css/dashboard.css" rel="stylesheet">
      <link rel="stylesheet" href="../bootstrap/dist/awesome/css/font-awesome.min.css" 	crossorigin="anonymous">      	  
	  <script src="../jquery/jquery-3.3.1.min.js"></script>	  
      <link rel="stylesheet" href="../bootstrap/dist/toastr/toastr.min.css" 			crossorigin="anonymous">	

	
  </head>
<style>
<!--
-->
</style>
 <body>
	
    <nav class="navbar navbar-dark sticky-top navbar-expand-lg flex-md-nowrap p-0" > 
    
	 
     <a id="a_titulo"  class="sombra_texto navbar-brand col-sm-6 col-md-2 mr-0" href="#"><b id="b_titulo">LOGISTICA</b>
		<img class="contorno" id="img_logo" src="../imagenes/JPG/logo_sin_letra.jpg" width="25px" />
	 </a>

    <ul id="menu_horizontal" class="navbar-nav mr-auto mt-6 mt-lg-0"></ul>


      <ul class="navbar-nav px-2">
		  
		  <li id="li_menu"  class="nav-item dropdown align-content-between">
			<a id="a_nombreusuario" class="sombra_texto nav-link dropdown-toggle active" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><b><?PHP echo $_SESSION['nombre'];?></b></a>
      		<div  class="dropdown-menu">
				 
				 <?PHP if ($_SESSION['rol'] == 9){ ?>
					  <a id="a_rolA" class="dropdown-item disabled" href="#">Rol - <b><?PHP echo $_SESSION['nrol'];?></b></a>
				 <?PHP }else{?>
					  <a id="a_rolB" class="dropdown-item disabled" href="#">Rol - <b><?PHP echo $_SESSION['nrol'];?></b></a>
				 <?PHP }?>
				  
				  <a class="dropdown-item disabled" href="#">Grupo - <?PHP echo $_SESSION['ngrupo'];?></a>
				  <div class="dropdown-divider"></div>
					  <a class="dropdown-item" href="#" id="link_cambiaclave"><i class="fa fa-key" aria-hidden="true"></i> - Cambiar Clave</a>			  
				 
				 <?PHP if ($_SESSION['rol'] == 9){ ?>
					  <div class="dropdown-divider"></div>
						  <a class="dropdown-item" href="#" id="link_grupo"><i  class="fa fa-users" 				aria-hidden="true"></i> - Grupos </a>
						  <a class="dropdown-item" href="#" id="link_rol"><i    class="fa fa-exclamation-triangle"  aria-hidden="true"></i> - Roles </a>
						  <a class="dropdown-item" href="#" id="link_asigan"><i class="fa fa-user-plus" 			aria-hidden="true"></i> - Asignar User</a>
					  <div class="dropdown-divider"></div>	  
						  <a class="dropdown-item" href="#" id="link_base_datos"><i class="fa fa-database"     aria-hidden="true"></i> - Base de Datos</a>
						  <a class="dropdown-item" href="#" id="link_sistema"><i class="fa fa-external-link"   aria-hidden="true"></i> - Sistemas</a>

						  <!-- manejar por el GRUPO -->
						  <a class="dropdown-item" href="#" id="link_apertura"><i class="fa fa-window-maximize" aria-hidden="true"></i> - APERTURA DE PERIDO </a>
					  
				  <?PHP }?>
				  <div class="dropdown-divider"></div>	  
				  <a class="dropdown-item" href="#"><i class="fa fa-question-circle" aria-hidden="true"></i> Ayuda</a>
			</div>
		  </li>	     
	 
	    <li class="nav-item text-nowrap">
          <a id="a_desconectar" class="sombra_texto nav-link" href="../index.php">Desconectar</a>
        </li>
     
	  </ul>

    </nav>

    <div id="x1" class="container-fluid">
      <div id="x2" class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
          <div id="x3" class="sidebar-sticky">
            <ul class="nav flex-column">
              
			  <li class="nav-itemP">
               <a id="link_menu" href="#menu_ppal" style="color:#3399CC" class="list-group-item collapsed" data-toggle="collapse" data-parent="#sidebar" aria-expanded="false">
                  <span data-feather="home"></span>
                  Menu <span class="sr-only">(current)</span>
                </a>
              </li>      

              
			  <!--
			  <li class="nav-itemP">
                <a id="mnu_base_datos" class="nav-link" href="#">
                  <span data-feather="database"></span>
                  Base de Datos
                </a>
              </li>		  
			  -->
			  		  
              <li class="nav-itemP">
                <a id="mnu_sucursales" class="nav-link" href="#">
                  <span data-feather="home"></span>
                  Sucursales
                </a>
              </li>	
			  

              <li class="nav-itemP">
                <a id="mnu_cta_contable" class="nav-link" href="#">
                  <span data-feather="list"></span>
                  Ctas Contables
                </a>
              </li>	

              <li class="nav-itemP">
                <a id="mnu_partida_presup" class="nav-link" href="#">
                  <span data-feather="archive"></span>
                   Partidas Presup.
                </a>
              </li>	


              <li class="nav-itemP">
                <a id="mnu_estru_presup" class="nav-link" href="#">
                  <span data-feather="book-open"></span>
                  Estruc. Presupuestaria
                </a>
              </li>	
				
			  <li class="nav-itemP dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="mnu_programa" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				  <span data-feather="book"></span>
				  Programas
				</a>
					<div class="dropdown-menu">
					  
					  <a class="dropdown-item nav-link menu_pqn" id="mnu_programa_creacion" 	href="javascript:enviar_pagina('mnu_programa','issg_programa.php')">
					  <i class="fa fa-address-book-o" aria-hidden="true"></i></span>
					  Creación					  
					  </a>
		
					  <a class="dropdown-item nav-link menu_pqn" id="mnu_programa_detalle" 	href="javascript:enviar_pagina('mnu_programa_detalle','issg_programa_detalle.php')">
					  <i class="fa fa-tasks" aria-hidden="true"></i>
					  Detalle
					  </a>
					
					</div>
			  </li>
				
				
              <li class="nav-itemP">
                <a id="mnu_factura_serie" class="nav-link" href="#">
                  <span data-feather="folder"></span>
                  Series de Facturas
                </a>
              </li>
			  
              <li class="nav-itemP">
                <a id="mnu_aso_cont_presup_insta" class="nav-link" href="#">
                  <span data-feather="check"></span>
                  Asociar Contab/Presup
                </a>
              </li>
			  
              <li class="nav-itemP">
                <a id="mnu_saint_bco" class="nav-link" href="#">
                  <span data-feather="check-square"></span>
                  Banco
                </a>
              </li>				  
			  
            <!--
			  <li class="nav-itemP">
                <a id="mnu_reporte" class="nav-link" href="#">
                  <span data-feather="bar-chart-2"></span>
                  Reportes
                </a>
              </li>
			-->  
              <li class="nav-itemP">
                <a id="mnu_integracion" class="nav-link" href="#">
                  <span data-feather="layers"></span>
                  Integración
                </a>
              </li>
			  
              <!--
			  <li class="nav-itemP">
                <a id="mnu_usuario" class="nav-link" href="#">
                  <span data-feather="users"></span>
                  Usuarios
                </a>
              </li>
			  -->
			  
            </ul>
<!--            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">titulo  </h6> -->
		    <ul class="nav flex-column mb-2">
				<div class="list-group panel">
				
					<a href="#menu1" class="list-group-item collapsed" data-toggle="collapse" data-parent="#sidebar" aria-expanded="false">
						<span data-feather="file-text"></span> 
							<span class="hidden-sm-down"> <span>Reportes Genrados </span><span data-feather="plus-circle"></span>				
						</span> 
					</a>

					<div class="collapse" id="menu1">
						<!--Administración -->
						<a href="#menu1sub1" class="list-group-item d-flex align-items-center text-muted" data-toggle="collapse" aria-expanded="false"><i class="fa fa-file"></i>&nbsp; Administración &nbsp; <i class="fa fa-caret-down" aria-hidden="true"></i></a>
							<div class="collapse" id="menu1sub1">
							 <li class="nav-item">
								<a href="#" class="nav-link" data-parent="#menu1sub1"><span data-feather="file"></span> Ventas</a>
								<a href="#" class="nav-link" data-parent="#menu1sub1"><span data-feather="file"></span> Compras</a>
								<a href="#" class="nav-link" data-parent="#menu1sub1"><span data-feather="file"></span> Estadistica</a>
							  </li>
							</div>
						<!--contabilidad -->	
						<a href="#menu2sub2" class="list-group-item d-flex align-items-center text-muted" data-toggle="collapse" aria-expanded="false"><i class="fa fa-file"></i>&nbsp; Contabilidad &nbsp; <i class="fa fa-caret-down" aria-hidden="true"></i></a>
							<div class="collapse" id="menu2sub2">
							 <li class="nav-item">
								<a href="#" class="nav-link" data-parent="#menu2sub2"><span data-feather="file"></span> Debe</a>
								<a href="#" class="nav-link" data-parent="#menu2sub2"><span data-feather="file"></span> Haber</a>
								<a href="#" class="nav-link" data-parent="#menu2sub2"><span data-feather="file"></span> Balance</a>
							  </li>
							</div>
					</div> <!--fin id="menu1"-->
				</div>
				
				
			  <!--
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
 -->            </ul>
          </div>
        </nav>

				
		<main  id="main1" role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4"  >
			<div  id="contenedor">							
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
function enviar_pagina(menu,pagina){

	//alert(menu + ' ' + pagina);
	$("#contenedor").empty();		
	$('#'+menu).last().addClass("active");	
	$('#contenedor').load('../paginas/'+pagina);
}

$(document).ready(function(){

	// marca el item actual en azul
	$(function() {
		var itemp = $(".nav-itemP a");
		
		itemp.click(function() {
			
			itemp.removeClass('active');
			$(this).addClass('active');
		});		
	});


	$('#link_menu').on('click', function(){				
		$("#contenedor").empty();		
		$('#mnu').last().addClass("active");		
	});

	/*
	$('#mnu_base_datos').on('click', function(){					
		$("#contenedor").empty();		
		$('#mnu_base_datos').last().addClass("active");	
		$('#contenedor').load('../paginas/issg_base_datos.php');		
	});
	*/
	
	
	$('#mnu_sucursales').on('click', function(){					
		$("#contenedor").empty();		
		$('#mnu_sucursales').last().addClass("active");	
		$('#contenedor').load('../paginas/issg_sucursal.php');		
	});
	
	/*$('#mnu_programa').on('click', function(){					
		$("#contenedor").empty();		
		$('#mnu_programa').last().addClass("active");	
		$('#contenedor').load('../paginas/issg_programa.php');		
	});*/

	/*$('#mnu_programa_detalle').on('click', function(){					
		$("#contenedor").empty();		
		$('#mnu_programa_detalle').last().addClass("active");	
		$('#contenedor').load('../paginas/issg_programa_detalle.php');		
	});*/
	
	$('#mnu_cta_contable').on('click', function(){				
		$("#contenedor").empty();		
		$('#mnu_cta_contable').last().addClass("active");
		$('#contenedor').load('../paginas/issg_cta_contable.php');	
  	});
	
	$('#mnu_partida_presup').on('click', function(){				
		$("#contenedor").empty();		
		$('#mnu_partida_presup').last().addClass("active");
		$('#contenedor').load('../paginas/issg_partida_presupuestaria.php');	
  	});
	
	$('#mnu_estru_presup').on('click', function(){				
		$("#contenedor").empty();		
		$('#mnu_estru_presup').last().addClass("active");
		$('#contenedor').load('../paginas/issg_estru_presup.php');	
  	});	

	$('#mnu_factura_serie').on('click', function(){				
		$("#contenedor").empty();		
		$('#mnu_factura_serie').last().addClass("active");
		$('#contenedor').load('../paginas/issg_factura_serie.php');	
  	});	

	$('#mnu_saint_bco').on('click', function(){				
		$("#contenedor").empty();		
		$('#mnu_saint_bco').last().addClass("active");
		$('#contenedor').load('../paginas/issg_saint_banco.php');	
  	});	

	
	$('#mnu_reporte').on('click', function(){				
		$("#contenedor").empty();		
		$('#mnu_reporte').last().addClass("active");
		//$('#contenedor').load('../paginas/issg_cta_contable.php');	
  	});	
	
	$('#mnu_integracion').on('click', function(){				
		$("#contenedor").empty();		
		$('#mnu_integracion').last().addClass("active");
		//$('#contenedor').load('../paginas/issg_cta_contable.php');	
  	});		

	$('#mnu_usuario').on('click', function(){				
		$("#contenedor").empty();		
		$('#mnu_usuario').last().addClass("active");
		//$('#contenedor').load('../paginas/issg_cta_contable.php');	
  	});	
		
	$('#mnu_aso_cont_presup_insta').on('click', function(){				
		$("#contenedor").empty();		
		$('#mnu_aso_cont_presup_insta').last().addClass("active");
		$('#contenedor').load('../paginas/issg_aso_contab_presu.php');
  	});
	
  	$('#link_cambiaclave').on('click', function(){
    	$("#contenedor").empty();
    	$('#contenedor').load('../paginas/issg_cambioclave.php');
  	});	

  	$('#link_grupo').on('click', function(){
    	$("#contenedor").empty();
    	$('#contenedor').load('../paginas/issg_grupo.php');
  	});	

  	$('#link_rol').on('click', function(){
    	$("#contenedor").empty();
    	$('#contenedor').load('../paginas/issg_rol.php');
  	});	
		
  	$('#link_asigan').on('click', function(){
    	$("#contenedor").empty();
    	$('#contenedor').load('../paginas/issg_usuario.php');
  	});		
	
  	$('#link_base_datos').on('click', function(){
    	$("#contenedor").empty();
    	$('#contenedor').load('../paginas/issg_base_datos.php');
  	});	
	
  	$('#link_sistema').on('click', function(){
    	$("#contenedor").empty();
    	$('#contenedor').load('../paginas/issg_sistema.php');
  	});	
	
  	$('#link_apertura').on('click', function(){
    	$("#contenedor").empty();
    	$('#contenedor').load('../paginas/issg_apertura.php');
  	});	

  	$('#link_menu').on('click', function(){
    	$("#contenedor").empty();
  	});
	


});	//  fin $(document).ready(
</script>	
	
  </body>

</html>