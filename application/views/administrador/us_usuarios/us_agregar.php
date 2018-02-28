<!DOCTYPE html>
<html lang="en" class="no-js">
	<head>
		<title>Mia Office | Agregar Usuario</title>
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
					<ol class="breadcrumb">
						<li class="active">
							<i class="fa fa-asterisk" style="color: #999;"></i> Campos Requeridos
						</li>
					</ol>
					<div class="page-header">
						<h1>Agregar Usuario</h1>
					</div>
				</div>
			</div>
			<div class="container">
				<div class="row">
					<form method="POST" id="formulario_usuario" action="<?= base_url(); ?>us_usuarios/ejecutar_registrar_nuevo_usuario" class="form-horizontal" autocomplete="off">
					<div class="panel panel-default">
						<div class="panel-heading">
							Datos Personales
						</div>
						
						<div class="panel-body">
							
							<div class="form-group">
								<!-- Nombre -->
								<div class="col-xs-12 col-sm-3">
									<label class="control-label" >* Nombre</label>
									<input type="text" placeholder="Nombre" name="us_nombre" id="us_nombre" class="form-control" value="<?= set_value('us_nombre'); ?>">
									<span class="pull-center error_us_nombre" style="color: red">
										<?= form_error('us_nombre'); ?></span>
								</div>
								<!-- Apellido Paterno -->
								<div class="col-xs-12 col-sm-3">
									<label class="control-label">* Apellido Paterno</label>
									<input type="text" placeholder="Apellido Paterno" name="us_apellido_paterno" 
									id="us_apellido_paterno" class="form-control" value="<?= set_value('us_apellido_paterno'); ?>">
									<span class="pull-center error_us_apellido_paterno" style="color: red">
										<?= form_error('us_apellido_paterno'); ?></span>
								</div>
								<!-- Apellido Materno -->
								<div class="col-xs-12 col-sm-3">
									<label class="control-label">Apellido Materno</label>
									<input type="text" placeholder="Apellido Materno" name="us_apellido_materno" id="us_apellido_materno" class="form-control" value="<?= set_value('us_apellido_materno'); ?>">
									<span class="pull-center error_us_apellido_materno" style="color: red">
										<?= form_error('us_apellido_materno'); ?></span>
								</div>
								<!-- Correo -->
								<div class="col-xs-12 col-sm-3">
									<label class="control-label">* Correo</label>
									<input type="email" placeholder="Correo" name="us_correo" id="us_correo" class="form-control" value="<?= set_value('us_correo'); ?>">
									<span class="pull-center error_us_correo" style="color: red">
										<?= form_error('us_correo'); ?></span>
								</div>
							</div>
						</div>
					</div>
					<div class="panel panel-default">
						<div class="panel-heading">
							Datos Usuario
						</div>
						
						<div class="panel-body">
							
							<div class="form-group">
								<!-- Correo -->
								<div class="col-xs-12 col-sm-3">
									<label class="control-label" >* Usuario</label>
									<input type="text" placeholder="Nombre" name="us_usuario" id="us_usuario" class="form-control tooltips" data-placement="top" data-rel="tooltip" data-original-title="El nombre de usuario solo debe contener letras y numeros, con longitud de 5 a 15 caracteres." value="<?= set_value('us_usuario'); ?>">
									<span class="pull-center error_us_usuario" style="color: red">
										<?= form_error('us_usuario'); ?></span>
								</div>
								<!-- Contraseña -->
								<div class="col-xs-12 col-sm-3">
									<label class="control-label">* Contraseña</label>
									<span class="input-help">
									<input type="password" placeholder="Contraseña" name="us_contrasenia" 
									id="us_contrasenia" class="form-control">
									<i class="help-button popovers" data-placement="right" data-trigger="hover" data-rel="popover" data-original-title="La contraseña debe contener 1 letra en mayúscula, 1 símbolo y 1 dígito numérico y sin espacios en una palabra de 6 a 10 letras."></i>
									</span>
									<span class="pull-center error_us_contrasenia" style="color: red">
										<?= form_error('us_contrasenia'); ?></span>
								</div>
								<!-- Confirmar Contraseña -->
								<div class="col-xs-12 col-sm-3">
									<label class="control-label">* Confirmar contraseña</label>
									<span class="input-help">
									<input type="password" placeholder="Confirmar Contraseña" name="us_fcontrasenia" id="us_fcontrasenia" class="form-control">
									<i class="help-button popovers" data-placement="right" data-trigger="hover" data-rel="popover" data-original-title="La contraseña debe contener 1 letra en mayúscula, 1 símbolo y 1 dígito numérico y sin espacios en una palabra de 6 a 10 letras."></i>
									</span>

									<span class="pull-center error_us_fcontrasenia" style="color: red">
										<?= form_error('us_fcontrasenia'); ?></span>
								</div>
								<!-- Nivel Usuario -->
								<div class="col-xs-12 col-sm-3">
									<label class="control-label">* Nivel de Usuario</label>
									<select class="form-control" id="us_id_nivel_usuario" name="us_id_nivel_usuario">
										<option value="">Nivel de Usuario</option>
										<?php foreach($nivel_usuario as $row): ?>
										<option value="<?= $row->nu_id_nivel_usuario; ?>"  
								        <?= set_select('us_id_nivel_usuario', $row->nu_id_nivel_usuario); ?>  >
								        <?= $row->nu_nombre; ?></option>	
										<?php endforeach; ?>
									</select>
									<span class="pull-center error_us_id_nivel_usuario" style="color: red">
										<?= form_error('us_id_nivel_usuario'); ?></span>
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
		<script src="<?= js_url(); ?>main.js"></script>
		<script src="<?= js_url(); ?>jquery-confirm.min.js"></script>
		<script>
			jQuery(document).ready(function() {
				Main.init();
			});
		</script>
		<script type="text/javascript">

		function validaciongeneral(){
		 	var band  = 0; 
			var req = "Requerido";

			var us_nombre                 =  $('#us_nombre').val();
			var us_apellido_paterno       =  $('#us_apellido_paterno').val();
			var us_correo	              =  $('#us_correo').val();

		    var us_usuario                =  $('#us_usuario').val();
			var us_contrasenia            =  $('#us_contrasenia').val();
			var us_fcontrasenia           =  $('#us_fcontrasenia').val();
			var us_id_nivel_usuario       =  $('#us_id_nivel_usuario').val();
			
		    
		  if (
		    us_nombre.trim() !="" && 
		  	us_apellido_paterno.trim() != "" && 
		  	us_correo.trim() != "" &&
		    us_usuario.trim() != ""  && 
		  	us_contrasenia.trim() != ""  && 
		  	us_fcontrasenia.trim() != ""  && 
		  	us_id_nivel_usuario.trim() != "" 
			){
		  	$(".error_us_nombre").text("");
		  	$(".error_us_apellido_paterno").text("");
		  	$(".error_us_correo").text("");
		    $(".error_us_usuario").text("");
		  	$(".error_us_contrasenia").text("");
		  	$(".error_us_fcontrasenia").text("");
		  	$(".error_us_id_nivel_usuario").text("");
		  	

			//validando que el correo se encuentre bien escrito
			var expreg_correo = /[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
			if(expreg_correo.test(us_correo.trim())){
		  	 $(".error_us_correo").html('');
		  	}else{
		  	 $(".error_us_correo").html('El correo es incorrecto.');
		  	band = 2;
		  	}

		  	//validando que la contraseña se encuentre bien escrita
			var expreg_pass = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&#])([A-Za-z\d$@$!%*?&#]|[^ ]){6,10}$/;
		  	if(expreg_pass.test(us_contrasenia.trim())){
		        $(".error_us_contrasenia").html('');
		    }else{
		        $(".error_us_contrasenia").html('La contraseña debe contener 1 letra en mayúscula, 1 símbolo y 1 dígito numérico y sin espacios en una palabra de 6 a 10 letras.');
		  		band = 2;
		    }
		    
		    //validando que la contraseña y confirmacion de contraseña coincidan
			if(us_contrasenia.trim()!= us_fcontrasenia.trim()){
		        $(".error_us_fcontrasenia").html('La contraseña y la confirmacion de contraseña son diferentes.');
		        band = 2;
		    }
		    
		    //validando que el nombre de usuario solo contenga letras y numeros 
		        var expreg_usuario =/^[a-z\d_]{5,20}$/i;
		        if(expreg_usuario.test(us_usuario.trim())){
		            $(".error_us_usuario").html('');
		        }else{
		            $(".error_us_usuario").html('El nombre de usuario solo debe contener letras y numeros, con longitud de 5 a 15 caracteres.');
		            bad= 2;
		        }
		        
		    if(band==0){
		        $.ajax({
		            type: 'POST',
		            url:  '<?php echo base_url(); ?>Us_usuarios/validar_usuario_ajax',
		            data: $("#formulario_usuario").serialize(),
		            dataType: 'json',
		            success: function(resp) { 
		                //valida que no se repita el correo
		                if(resp.error_us_correo==0){
		                    $(".error_us_correo").html('');
		                }else{
		                    $(".error_us_correo").html('El correo electronico '+us_correo.trim()+' ya ha sido registrado.');
		                }
		                //valida que no se repita el nombre de usuario
		                if(resp.error_us_usuario==0){
		                    $(".error_us_usuario").html('');
		                }else{
		                    $(".error_us_usuario").html('El nombre de usuario '+us_usuario.trim()+' ya ha sido registrado.');
		                }
		                //todo correcto entra a enviar el formulario
		                if( resp.error_us_correo==0 && resp.error_us_usuario==0){
		                    $.confirm({
								title: '¿Deseas registrar un nuevo usuario?',
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
						                $('#formulario_usuario').submit();
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
		        });
		    }
		}
		    if (
		        us_nombre.trim() == "" && 
		        us_apellido_paterno.trim() == "" && 
		        us_correo.trim() == "" && 
		        us_usuario.trim() == ""  &&
		        us_contrasenia.trim() == ""  && 
		        us_fcontrasenia.trim() == ""  && 
		        us_id_nivel_usuario.trim() == ""
		    ){
		        $(".error_us_nombre").text(req);
		        $(".error_us_apellido_paterno").text(req);
		        $(".error_us_correo").text(req);
		        $(".error_us_usuario").text(req);
		        $(".error_us_contrasenia").text(req);
		        $(".error_us_fcontrasenia").text(req);
		        $(".error_us_id_nivel_usuario").text(req);
		        return false;	
		    }
		    if (
		        us_nombre.trim() == "" || 
		        us_apellido_paterno.trim() == "" || 
		        us_correo.trim() == "" || 
		        us_usuario.trim() == ""  ||
		        us_contrasenia.trim() == ""|| 
		        us_fcontrasenia.trim() == ""  || 
		        us_id_nivel_usuario.trim() == ""  
		    ){
		    if(us_nombre.trim() == "")$(".error_us_nombre").text(req);
		        else $(".error_us_nombre").text("");

		    if(us_apellido_paterno.trim() == "")$(".error_us_apellido_paterno").text(req);
		        else $(".error_us_apellido_paterno").text("");

		    if(us_correo.trim() == "")$(".error_us_correo").text(req);
		        else $(".error_us_correo").text("");

		    if(us_usuario.trim() == "")$(".error_us_usuario").text(req);
		        else $(".error_us_usuario").text("");

		    if(us_contrasenia.trim() == "")$(".error_us_contrasenia").text(req);
		        else $(".error_us_contrasenia").text("");

		    if(us_fcontrasenia.trim() == "")$(".error_us_fcontrasenia").text(req);
		        else $(".error_us_fcontrasenia").text("");

		    if(us_id_nivel_usuario.trim() == "")$(".error_us_id_nivel_usuario").text(req);
		        else $(".error_us_id_nivel_usuario").text("");

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
							location.href='<?= base_url(); ?>us_usuarios';
						}
					},
				}
			});
		});
		</script>
	</body>
</html>