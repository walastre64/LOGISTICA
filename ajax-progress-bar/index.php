<?php 
require('config.php');
$result = $connexion->query('SELECT COUNT(*) as total_comments FROM comments');
$row = $result->fetch_assoc();
$num_total_rows = $row['total_comments'];

$update_process = 'UPDATE process SET total = '.$num_total_rows.', percentage = 0, executed = 0, execute_time = "", date_add = now() WHERE id_process = 1';
$connexion->query($update_process);
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Barra de progreso con jQuery, Ajax y PHP Demo</title>
<meta name="description" content="Barra de progreso con jQuery, Ajax y PHP..."/>
<meta name="author" content="Jose Aguilar">
<link rel="shortcut icon" href="https://www.jose-aguilar.com/blog/wp-content/themes/jaconsulting/favicon.ico" />
<link rel="stylesheet" href="css/font-awesome.min.css">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<link rel="stylesheet" href="css/styles.css">
<script src="https://code.jquery.com/jquery-3.2.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script type="text/javascript">
function executeProcess(offset, batch = false) {
    if (batch == false) {
        batch = parseInt($('#batch').val());
    } else {
        batch = parseInt(batch);
    }
    
    if (offset == 0) {
        $('#start_form').hide();
        $('#sending').show();
        $('#sended').text(0);
        $('#total').text($('#total_comments').val());
        
        //reset progress bar
        $('.progress-bar').css('width', '0%');
        $('.progress-bar').text('0%');
        $('.progress-bar').attr('data-progress', '0');
    }

    $.ajax({ 
        type: 'POST',
        dataType: "json",
        url : "process.php", 
        data: {
            id_process: 1,
            offset: offset,
            batch: batch
        },
        success: function(response) {
            $('.progress-bar').css('width', response.percentage+'%');
            $('.progress-bar').text(response.percentage+'%');
            $('.progress-bar').attr('data-progress', response.percentage);
            
            $('#done').text(response.executed);
            $('.execute-time').text(response.execute_time);
            
            if (response.percentage == 100) {
                $('.end-process').show();
            } else {
                var newOffset = offset + batch;
                
                executeProcess(newOffset, batch);
            }
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
            if (textStatus == 'parsererror') {
                textStatus = 'Technical error: Unexpected response returned by server. Sending stopped.';
            }
            alert(textStatus);
       }
    });
}
</script>
</head>

<body>
<nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark">
    <a class="navbar-brand" href="https://www.jose-aguilar.com/">
        <img src="https://www.jose-aguilar.com/blog/wp-content/themes/jaconsulting/images/jose-aguilar.png" width="30" height="30" alt="Jose Aguilar">
      </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
            <a class="nav-item nav-link active" href="https://www.jose-aguilar.com/scripts/jquery/ajax-progress-bar/">Demo <span class="sr-only">(current)</span></a>
            <a class="nav-item nav-link" href="https://www.jose-aguilar.com/scripts/jquery/ajax-progress-bar/ajax-progress-bar.zip">Descargar</a>
            <a class="nav-item nav-link" href="https://www.jose-aguilar.com/blog/paginacion-jquery-ajax-php/">Tutorial</a>
            <a class="nav-item nav-link" href="https://www.jose-aguilar.com/">&copy; Jose Aguilar</a>
        </div>
    </div>
</nav>
<div class="container">
    <h1>Barra de progreso con jQuery, Ajax y PHP</h1>
    <h2 class="lead"><?php echo $num_total_rows; ?> comentarios a procesar</h2>
    
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="https://www.jose-aguilar.com/blog/">Blog</a></li>
          <li class="breadcrumb-item"><a href="https://www.jose-aguilar.com/blog/paginacion-jquery-ajax-php/">Paginación de resultados con jQuery, Ajax y PHP</a></li>
          <li class="breadcrumb-item active" aria-current="page">Demo</li>
        </ol>
    </nav>
    
    <div class="row">
        <div id="content" class="col-lg-12">
<form id="start_form" action="#" method="post">
    <input type="hidden" id="total_comments" name="total_comments" value="<?php echo $num_total_rows; ?>" />
    <div class="form-group">
        <label for="batch">Número de elementos que se procesan en cada iteración</label>
        <select class="form-control" id="batch" name="batch">
            <?php
            //divisors
            for($i = 1; $i < $num_total_rows; $i ++) {
                if ($num_total_rows % $i == 0) {
                    echo '<option value="'.$i.'">'.$i.'</option>';
                }
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <a href="#" class="btn btn-primary" onclick="executeProcess(0);return false;">
            <i class="fa fa-eye"></i> Ejecutar
        </a>
    </div>
</form>
        </div>
<div id="sending" class="col-lg-12" style="display:none;">
    <h3>Procesando...</h3>
    <div class="progress">
        <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" data-progress="0" style="width: 0%;">
            0%
        </div>
    </div>
    <div class="counter-sending">
        (<span id="done">0</span>/<span id="total">0</span>)
    </div>

    <div class="execute-time-content">
        Tiempo transcurrido: <span class="execute-time">0 segundos</span>
    </div>

    <div class="end-process" style="display:none;">
        <div class="alert alert-success">El proceso ha sido completado. <a href="https://www.jose-aguilar.com/scripts/jquery/ajax-progress-bar/">Probar otra vez</a></div>
    </div>    
</div>
</div>
    
    <div class="row">
        <div class="col-lg-12">
            <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
            <!-- Bloque de anuncios adaptable -->
            <ins class="adsbygoogle"
                 style="display:block"
                 data-ad-client="ca-pub-6676636635558550"
                 data-ad-slot="8523024962"
                 data-ad-format="auto"
                 data-full-width-responsive="true"></ins>
            <script>
            (adsbygoogle = window.adsbygoogle || []).push({});
            </script>
        </div>
    </div>
    
    <div class="card">
        <h5 class="card-header">Comparte en las redes sociales</h5>
        <div class="card-body">
            <h5 class="card-title">¿Te ha servido este ejemplo? Comparte con tus amigos</h5>
            <!-- Go to www.addthis.com/dashboard to customize your tools -->
            <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-4ecc1a47193e29e4" async="async"></script>
            <!-- Go to www.addthis.com/dashboard to customize your tools -->
            <div class="addthis_sharing_toolbox"></div>
        </div>
    </div>

    <div class="footer-content row">
        <div class="col-lg-12">
            <div class="pull-right">
                <a href="https://www.jose-aguilar.com/blog/paginacion-jquery-ajax-php/" class="btn btn-secondary">
                    <i class="fa fa-reply"></i> volver al tutorial
                </a>
                <a href="https://www.jose-aguilar.com/scripts/jquery/ajax-progress-bar/ajax-progress-bar.zip" class="btn btn-primary">
                    <i class="fa fa-download"></i> Descargar
                </a>
            </div>
        </div>
    </div>
    
</div>
<footer class="footer bg-dark">
    <div class="container">
        <span class="text-muted"><a href="https://www.jose-aguilar.com/">&copy; Jose Aguilar</a></span>
    </div>
</footer>
</body>
</html>
