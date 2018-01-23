<!DOCTYPE html>
<html lang="en" class="no-js">
	<head>
		<title>Mia Office | Editar Oficina</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<meta content="" name="description" />
		<meta content="" name="author" />
		<!-- end: META -->
		<!-- start: MAIN CSS -->
		<link rel="stylesheet" href="<?= plugin_url(); ?>bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="<?= plugin_url(); ?>font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="<?= asset_url(); ?>fonts/style.css">
		<link rel="stylesheet" href="<?= css_url(); ?>main.css">
		<link rel="stylesheet" href="<?= css_url(); ?>main-responsive.css">
		<link rel="stylesheet" href="<?= plugin_url(); ?>iCheck/skins/all.css">
		<link rel="stylesheet" href="<?= plugin_url(); ?>bootstrap-colorpalette/css/bootstrap-colorpalette.css">
		<link rel="stylesheet" href="<?= plugin_url(); ?>perfect-scrollbar/src/perfect-scrollbar.css">
		<link rel="stylesheet" href="<?= css_url(); ?>theme_light.css" type="text/css" id="skin_color">
		<link rel="stylesheet" href="<?= css_url(); ?>jquery-confirm.min.css">
		<!--[if IE 7]>
		<link rel="stylesheet" href="assets/plugins/font-awesome/css/font-awesome-ie7.min.css">
		<![endif]-->
		<!-- end: MAIN CSS -->
		<!-- start: CSS REQUIRED FOR THIS PAGE ONLY -->
		<!-- end: CSS REQUIRED FOR THIS PAGE ONLY -->
		<link rel="shortcut icon" href="favicon.ico" />
	</head>
	<!-- end: HEAD -->
	<!-- start: BODY -->
	<body>
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div class="page-header">
						<h1>Editar Oficina</h1>
					</div>
				</div>
			</div>
			<div class="container">
				<div class="row">
					<form method="POST" id="formulario_oficina" action="<?= base_url(); ?>of_oficinas/ejecutar_editar_oficina" class="form-horizontal" autocomplete="off">
					
					<input type="hidden" name="id" value="<?= isset($oficina)?$oficina->of_id_oficina:set_value('id'); ?>">

					<div class="panel panel-default">
						<div class="panel-heading">
							<i class="fa fa-asterisk" style="color: #999;"></i> Campos Requeridos
						</div>
						
						<div class="panel-body">
							
							<div class="form-group">
								<!-- Nombre -->
								<div class="col-xs-12 col-sm-4">
									<label class="control-label" >* Oficina</label>
									<input type="text" placeholder="Oficina" name="of_nombre" id="of_nombre" class="form-control" value="<?= isset($oficina)?$oficina->of_nombre:set_value('of_nombre'); ?>">
									<span class="pull-center error_of_nombre" style="color: red">
										<?= form_error('of_nombre'); ?></span>
								</div>
								<!-- Nº Exterior -->
								<div class="col-xs-12 col-sm-4">
									<label class="control-label">* Precio</label>
									<input type="number" placeholder="Precio: $" name="of_precio" 
									id="of_precio" class="form-control" onkeypress="return SoloNumeros(event);" 
									value="<?= isset($oficina)?$oficina->of_precio:set_value('of_precio'); ?>">
									<span class="pull-center error_of_precio" style="color: red">
										<?= form_error('of_precio'); ?></span>
								</div>
								<!-- Nº Interior -->
								<div class="col-xs-12 col-sm-4">
									<label class="control-label">* Ubicación</label>
									<select class="form-control" id="of_id_ubicacion" name="of_id_ubicacion">
										<option value="">Ubicación</option>
										<?php foreach($ubicaciones as $row): ?>
										<option value="<?= $row->ub_id_ubicacion; ?>"  
								        <?= set_select('of_id_ubicacion', $row->ub_id_ubicacion); 
								        if($row->ub_id_ubicacion == $oficina->of_id_ubicacion) echo 'selected="selected"' ?>  >
								        <?php
								        $num_int = '';
										if(isset($row->ub_numero_interior )){
											$num_int = $row->ub_numero_interior;
										}
										$direccion = $row->ub_calle.' #'.$row->ub_numero_exterior.$num_int.' '.$row->ub_colonia.' C.P. '.$row->ub_codigo_postal;

								        echo $direccion; ?></option>	
										<?php endforeach; ?>
									</select>
									<span class="pull-center error_of_id_ubicacion" style="color: red">
										<?= form_error('of_id_ubicacion'); ?></span>
								</div>
							</div>
						</div>
					</div>
					</form>
					<div class="margin pull-right">
						<button type="button" class="btn btn-danger cancelar_usuario"> Cancelar</button>
						<button type="button" class="btn btn-success" onclick="validaciongeneral()"> Guardar</button>
					</div>
				</div>
			</div>
		</div>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
		<script src="<?= plugin_url(); ?>jquery-ui/jquery-ui-1.10.2.custom.min.js"></script>
		<script src="<?= plugin_url(); ?>bootstrap/js/bootstrap.min.js"></script>
		<script src="<?= plugin_url(); ?>bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js"></script>
		<script src="<?= plugin_url(); ?>blockUI/jquery.blockUI.js"></script>
		<script src="<?= plugin_url(); ?>iCheck/jquery.icheck.min.js"></script>
		<script src="<?= plugin_url(); ?>perfect-scrollbar/src/jquery.mousewheel.js"></script>
		<script src="<?= plugin_url(); ?>perfect-scrollbar/src/perfect-scrollbar.js"></script>
		<script src="<?= plugin_url(); ?>less/less-1.5.0.min.js"></script>
		<script src="<?= plugin_url(); ?>jquery-cookie/jquery.cookie.js"></script>
		<script src="<?= plugin_url(); ?>bootstrap-colorpalette/js/bootstrap-colorpalette.js"></script>
		<script src="<?= plugin_url();?>input-mask/jquery.inputmask.js"></script>
		<script src="<?= plugin_url();?>input-mask/jquery.inputmask.date.extensions.js"></script>
		<script src="<?= plugin_url();?>input-mask/jquery.inputmask.extensions.js"></script>
		<script src="<?= js_url(); ?>main.js"></script>
		<script src="<?= js_url(); ?>jquery-confirm.min.js"></script>
		<script>
			jQuery(document).ready(function() {
				Main.init();
			});
		</script>
		<script type="text/javascript">

		$("[data-mask]").inputmask();

		function validaciongeneral(){
		 	var band  = 0; 
			var req = "Requerido";

			var of_nombre  		=  $('#of_nombre').val();
			var of_precio 		=  $('#of_precio').val();
			var of_id_ubicacion =  $('#of_id_ubicacion').val();
			
		    
		if(
			of_nombre.trim() !="" && 
		  	of_precio.trim() != "" && 
		  	of_id_ubicacion.trim() != ""
		){
		  	$(".error_of_nombre").text("");
		  	$(".error_of_precio").text("");
		  	$(".error_of_id_ubicacion").text("");
		  	
		        
		    if(band==0){
		        $.confirm({
					title: '¿Deseas editar la ubicación?',
          			theme: 'modern',
					closeIconClass: 'fa fa-close',
					icon: 'fa fa-exclamation-circle',
					animation: 'scale',
					type: 'red',
					content: '',
					buttons: {
						formSubmit: {
							text: 'Guardar',
						    btnClass: 'btn-green',
						    action: function () {
						    	$('#formulario_oficina').submit();
						    }
						},
						Cancel: {
							text: 'Cancelar',
						    btnClass: 'btn-red',
						    action: function () {
						    	//close
						    }
						},
					}
				});
		    }
		}
		
		if (
		    of_nombre.trim() == "" && 
		    of_precio.trim() == "" && 
		    of_id_ubicacion.trim() == ""  
		){
		    $(".error_of_nombre").text(req);
		    $(".error_of_precio").text(req);
		    $(".error_of_id_ubicacion").text(req);

		    return false;	
		}
		if (
			of_nombre.trim() == "" || 
		    of_precio.trim() == "" || 
		    of_id_ubicacion.trim() == ""  
		){
		    if(of_nombre.trim() == "")$(".error_of_nombre").text(req);
		        else $(".error_of_nombre").text("");

		    if(of_precio.trim() == "")$(".error_of_precio").text(req);
		        else $(".error_of_precio").text("");

		    if(of_id_ubicacion.trim() == "")$(".error_of_id_ubicacion").text(req);
		        else $(".error_of_id_ubicacion").text("");

		        return false;	
		}
	}

		$('.cancelar_usuario').click(function(){
			$.confirm({
				title: '¿Deseas Salir?',
          		theme: 'modern',
				closeIconClass: 'fa fa-close',
				icon: 'fa fa-sign-out',
				animation: 'scale',
				type: 'blue',
				content: '',
				buttons: {
					No: {
						text: 'No',
						btnClass: 'btn-red',
						action: function () {
						}
					},
					Si: {
						text: 'Si',
						btnClass: 'btn-green',
						action: function () {
							location.href='<?= base_url(); ?>of_oficinas';
						}
					},
				}
			});
		});

		function SoloNumeros(e) {
            key = e.keyCode || e.which;
            tecla = String.fromCharCode(key).toString();
            numeros = " 0123456789";//Se define todo el abecedario que se quiere que se muestre.
            especiales = [8, 37, 39, 46, 6, 9]; //Es la validación del KeyCodes, que teclas recibe el campo de texto.

            tecla_especial = false
            for(var i in especiales) {
                if(key == especiales[i]) {
                    tecla_especial = true;
                    break;
                }
            }

            if(numeros.indexOf(tecla) == -1 && !tecla_especial)
                return false;
            }
		</script>
	</body>
</html>