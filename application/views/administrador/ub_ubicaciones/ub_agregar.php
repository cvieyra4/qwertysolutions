<!DOCTYPE html>
<html lang="en" class="no-js">
	<head>
		<title>Mia Office | Agregar dirección</title>
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
						<h1>Agregar dirección</h1>
					</div>
				</div>
			</div>
			<div class="container">
				<div class="row">
					<form method="POST" id="formulario_ubicacion" action="<?= base_url(); ?>ub_ubicaciones/ejecutar_registrar_nueva_ubicacion" class="form-horizontal" autocomplete="off">
					<div class="panel panel-default">
						<div class="panel-heading">
							<i class="fa fa-asterisk" style="color: #999;"></i> Campos requeridos
						</div>
						
						<div class="panel-body">
							
							<div class="form-group">
								<!-- Nombre -->
								<div class="col-xs-12 col-sm-4">
									<label class="control-label" >* Nombre</label>
									<input type="text" placeholder="Nombre" name="ub_nombre" id="ub_nombre" class="form-control" value="<?= set_value('ub_nombre'); ?>">
									<span class="pull-center error_ub_nombre" style="color: red">
										<?= form_error('ub_nombre'); ?></span>
								</div>
								<!-- Calle -->
								<div class="col-xs-12 col-sm-4">
									<label class="control-label" >* Calle</label>
									<input type="text" placeholder="Calle" name="ub_calle" id="ub_calle" class="form-control" value="<?= set_value('ub_calle'); ?>">
									<span class="pull-center error_ub_calle" style="color: red">
										<?= form_error('ub_calle'); ?></span>
								</div>
								<!-- Nº Exterior -->
								<div class="col-xs-12 col-sm-4">
									<label class="control-label">* Nº exterior</label>
									<input type="number" placeholder="Nº exterior" name="ub_numero_exterior" 
									id="ub_numero_exterior" class="form-control" onkeypress="return SoloNumeros(event);" 
									value="<?= set_value('ub_numero_exterior'); ?>">
									<span class="pull-center error_ub_numero_exterior" style="color: red">
										<?= form_error('ub_numero_exterior'); ?></span>
								</div>
								<!-- Nº Interior -->
								<div class="col-xs-12 col-sm-4">
									<label class="control-label">Nº interior</label>
									<input type="text" placeholder="Nº interior" name="ub_numero_interior" 
									id="ub_numero_interior" class="form-control" 
									value="<?= set_value('ub_numero_interior'); ?>">
									<span class="pull-center error_ub_numero_interior" style="color: red">
										<?= form_error('ub_numero_interior'); ?></span>
								</div>
								<!-- Colonia -->
								<div class="col-xs-12 col-sm-4">
									<label class="control-label">* Colonia</label>
									<input type="text" placeholder="Correo" name="ub_colonia" id="ub_colonia" class="form-control" value="<?= set_value('ub_colonia'); ?>">
									<span class="pull-center error_ub_colonia" style="color: red">
										<?= form_error('ub_colonia'); ?></span>
								</div>

								<!-- Codigo Postal -->
								<div class="col-xs-12 col-sm-4">
									<label class="control-label">* C.P.</label>
									<input type="text" placeholder="C.P." name="ub_codigo_postal" id="ub_codigo_postal" class="form-control" data-inputmask='"mask": "99999"' data-mask 
									onkeypress="return SoloNumeros(event);" value="<?= set_value('ub_codigo_postal'); ?>">
									<span class="pull-center error_ub_codigo_postal" style="color: red">
										<?= form_error('ub_codigo_postal'); ?></span>
								</div>

								<!-- Estado -->
								<div class="col-xs-12 col-sm-4">
									<label class="control-label">* Estados</label>
									<select class="form-control" name="cve_ent" id="cve_ent">
										<option value="">Estados</option>
										<?php foreach($estados as $row): ?>
										<option value="<?= $row->cve_ent; ?>"
										<?= set_select('cve_ent', $row->cve_ent); ?> >
										<?= $row->nom_ent; ?></option>
										<?php endforeach; ?>
									</select>
									<span class="pull-center error_cve_ent" style="color: red">
										<?= form_error('cve_ent'); ?></span>
								</div>

								<!-- Municipio -->
								<div class="col-xs-12 col-sm-4">
									<label class="control-label">* Municipios</label>
									<select class="form-control" name="cve_mun" id="cve_mun">
										<option value="">Municipios</option>
										<?php foreach($municipios as $row): ?>
										<option value="<?= $row->cve_mun; ?>"
										<?= set_select('cve_mun', $row->cve_mun); ?>  >
										<?= $row->nom_mun; ?></option>
										<?php endforeach; ?>
									</select>
									<span class="pull-center error_cve_mun" style="color: red">
										<?= form_error('cve_mun'); ?></span>
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
		<script>
			$('#cve_ent').change(function(){
				var cve_ent = $(this).val();
				if(cve_ent != ""){
					$.ajax({
						type: 'post',
						url: '<?= base_url(); ?>ub_ubicaciones/getMunicipios',
						data: 'cve_ent='+cve_ent,
						dataType: 'json',
						success: function(resp){
							$('#cve_mun').html('<option value="000">* Municipio</option>');
							$.each(resp, function(k,v){
								$('#cve_mun').append('<option value="'+v.cve_mun+'">'+v.nom_mun+'</option>');
							});
						}
					});
				}
			});
		</script>
		<script type="text/javascript">

		$("[data-mask]").inputmask();

		function validaciongeneral(){
		 	var band  = 0; 
			var req = "Requerido";

			var ub_nombre 			= $('#ub_nombre').val();
			var ub_calle            = $('#ub_calle').val();
			var ub_numero_exterior  = $('#ub_numero_exterior').val();
		    var ub_colonia          = $('#ub_colonia').val();
			var ub_codigo_postal 	= $('#ub_codigo_postal').val();
			var cve_ent 			= $('#cve_ent').val();
			var cve_mun 			= $('#cve_mun').val();
			
		   	 
		if(
			ub_nombre.trim() !="" && 
			ub_calle.trim() !="" && 
		  	ub_numero_exterior.trim() != "" && 
		  	ub_colonia.trim() != "" &&
		    ub_codigo_postal.trim() != "" &&
		    cve_ent.trim() != "" &&
		    cve_mun.trim() != ""
		){
			$(".error_ub_nombre").text("");
		  	$(".error_ub_calle").text("");
		  	$(".error_ub_numero_exterior").text("");
		  	$(".error_ub_colonia").text("");
		    $(".error_ub_codigo_postal").text("");
		    $('.error_cve_ent').text("");
		    $('.error_cve_mun').text("");
		  	
		        
		    if(band==0){
		        $.confirm({
					title: '¿Deseas agregar nueva ubicación?',
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
						    	$('#formulario_ubicacion').submit();
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
			ub_nombre.trim() == "" && 
		    ub_calle.trim() == "" && 
		    ub_numero_exterior.trim() == "" && 
		    ub_colonia.trim() == "" && 
		    ub_codigo_postal.trim() == "" &&
		    cve_ent.trim() == "" &&
		    cve_mun.trim() == ""
		){
			$(".error_ub_nombre").text(req)
		    $(".error_ub_calle").text(req);
		    $(".error_ub_numero_exterior").text(req);
		    $(".error_ub_colonia").text(req);
		    $(".error_ub_codigo_postal").text(req);
		    $('.error_cve_ent').text(req);
		    $('.error_cve_mun').text(req);

		    return false;	
		}
		if (
			ub_nombre.trim() == "" || 
			ub_calle.trim() == "" || 
		    ub_numero_exterior.trim() == "" || 
		    ub_colonia.trim() == "" || 
		    ub_codigo_postal.trim() == "" ||
		    cve_ent.trim() == "" ||
		    cve_mun.trim() == "" 
		){
			if(ub_nombre.trim() == "")$(".error_ub_nombre").text(req);
		        else $(".error_ub_nombre").text("");

		    if(ub_calle.trim() == "")$(".error_ub_calle").text(req);
		        else $(".error_ub_calle").text("");

		    if(ub_numero_exterior.trim() == "")$(".error_ub_numero_exterior").text(req);
		        else $(".error_ub_numero_exterior").text("");

		    if(ub_colonia.trim() == "")$(".error_ub_colonia").text(req);
		        else $(".error_ub_colonia").text("");

		    if(ub_codigo_postal.trim() == "")$(".error_ub_codigo_postal").text(req);
		        else $(".error_ub_codigo_postal").text("");

		    if(cve_ent.trim() == "")$(".error_cve_ent").text(req);
		        else $(".error_cve_ent").text("");

		    if(cve_mun.trim() == "")$(".error_cve_mun").text(req);
		        else $(".error_cve_mun").text("");

		    return false;	
		}
	}

		$('.cancelar_usuario').click(function(){
			$.confirm({
				title: '¿Deseas salir?',
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
							location.href='<?= base_url(); ?>ub_ubicaciones';
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