<!DOCTYPE html>
<html lang="en" class="no-js">
	<head>
		<title>Mia Office | Editar cliente</title>
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
						<h1>Editar cliente <?= $cliente->cl_nombre.' '.$cliente->cl_apellido_paterno; ?></h1>
					</div>
				</div>
			</div>
			<div class="container">
				<div class="row">
					<form method="POST" id="formulario_cliente" action="<?= base_url(); ?>cl_clientes/ejecutar_editar_cliente" class="form-horizontal" autocomplete="off">
						<input type="hidden" name="id" value="<?= isset($cliente)?$cliente->cl_id_cliente:set_value('id'); ?>">
					<div class="panel panel-default">
						<div class="panel-heading">
							<i class="fa fa-asterisk" style="color: #999;"></i> Campos requeridos
						</div>
						
						<div class="panel-body">
							
							<div class="form-group">
								<!-- Nombre -->
								<div class="col-xs-12 col-sm-3">
									<label class="control-label" >* Nombre</label>
									<input type="text" placeholder="Nombre" name="cl_nombre" id="cl_nombre" class="form-control" value="<?= isset($cliente)?$cliente->cl_nombre:set_value('cl_nombre'); ?>">
									<span class="pull-center error_cl_nombre" style="color: red">
										<?= form_error('cl_nombre'); ?></span>
								</div>
								<!-- Apellido Paterno -->
								<div class="col-xs-12 col-sm-3">
									<label class="control-label">* Apellido paterno</label>
									<input type="text" placeholder="Apellido paterno" name="cl_apellido_paterno" 
									id="cl_apellido_paterno" class="form-control" 
									value="<?= isset($cliente)?$cliente->cl_apellido_paterno:set_value('cl_apellido_paterno'); ?>">
									<span class="pull-center error_cl_apellido_paterno" style="color: red">
										<?= form_error('cl_apellido_paterno'); ?></span>
								</div>
								<!-- Apellido Materno -->
								<div class="col-xs-12 col-sm-3">
									<label class="control-label">Apellido materno</label>
									<input type="text" placeholder="Apellido materno" name="cl_apellido_materno" id="cl_apellido_materno" class="form-control" 
									value="<?= isset($cliente)?$cliente->cl_apellido_materno:set_value('cl_apellido_materno'); ?>">
									<span class="pull-center error_cl_apellido_materno" style="color: red">
										<?= form_error('cl_apellido_materno'); ?></span>
								</div>
								<!-- Correo -->
								<div class="col-xs-12 col-sm-3">
									<label class="control-label">* Correo</label>
									<input type="email" placeholder="Correo" name="cl_correo" id="cl_correo" class="form-control" value="<?= isset($cliente)?$cliente->cl_correo:set_value('cl_correo'); ?>">
									<span class="pull-center error_cl_correo" style="color: red">
										<?= form_error('cl_correo'); ?></span>
								</div>

								<!-- Telefono -->
								<div class="col-xs-12 col-sm-3">
									<label class="control-label"> Teléfono</label>
									<input type="text" placeholder="Teléfono" name="cl_telefono" id="cl_telefono" class="form-control" data-inputmask='"mask": "999 999 9999"' data-mask 
									value="<?= isset($cliente)?$cliente->cl_telefono:set_value('cl_telefono'); ?>">
									<span class="pull-center error_cl_telefono" style="color: red">
										<?= form_error('cl_telefono'); ?></span>
								</div>

								<!-- Correo -->
								<div class="col-xs-12 col-sm-3">
									<label class="control-label" >* Usuario</label>
									<input type="text" placeholder="Usuario" name="cl_usuario" id="cl_usuario" class="form-control tooltips" data-placement="top" data-rel="tooltip" data-original-title="El nombre de usuario solo debe contener letras y numeros, con longitud de 5 a 15 caracteres." value="<?= isset($cliente)?$cliente->cl_usuario:set_value('cl_usuario'); ?>">
									<span class="pull-center error_cl_usuario" style="color: red">
										<?= form_error('cl_usuario'); ?></span>
								</div>
								<!-- Contraseña -->
								<div class="col-xs-12 col-sm-3">
									<label class="control-label">* Contraseña</label>
									<span class="input-help">
									<input type="password" placeholder="Contraseña" name="cl_contrasenia" 
									id="cl_contrasenia" class="form-control">
									<i class="help-button popovers" data-placement="right" data-trigger="hover" data-rel="popover" data-original-title="La contraseña consta de 10 caracteres: Primera letra Mayúscula + 8 Caracteres + Un simbolo al final (# - $ - % - &)"></i>
									</span>
									<span class="pull-center error_cl_contrasenia" style="color: red">
										<?= form_error('cl_contrasenia'); ?></span>
								</div>
								<!-- Confirmar Contraseña -->
								<div class="col-xs-12 col-sm-3">
									<label class="control-label">* Confirmar contraseña</label>
									<span class="input-help">
									<input type="password" placeholder="Confirmar contraseña" name="cl_fcontrasenia" id="cl_fcontrasenia" class="form-control">
									<i class="help-button popovers" data-placement="right" data-trigger="hover" data-rel="popover" data-original-title="La contraseña consta de 10 caracteres: Primera letra Mayúscula + 8 Caracteres + Un simbolo al final (# - $ - % - &)"></i>
									</span>

									<span class="pull-center error_cl_fcontrasenia" style="color: red">
										<?= form_error('cl_fcontrasenia'); ?></span>
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

			var cl_nombre            =  $('#cl_nombre').val();
			var cl_apellido_paterno  =  $('#cl_apellido_paterno').val();
			var cl_correo	         =  $('#cl_correo').val();

		    var cl_usuario           =  $('#cl_usuario').val();
			var cl_contrasenia       =  $('#cl_contrasenia').val();
			var cl_fcontrasenia      =  $('#cl_fcontrasenia').val();
			var cl_telefono       	 =  $('#cl_telefono').val();
			
		    
		  if (
		    cl_nombre.trim() !="" && 
		  	cl_apellido_paterno.trim() != "" && 
		  	cl_correo.trim() != "" &&
		    cl_usuario.trim() != ""  && 
		  	cl_telefono.trim() != "" 
			){
		  	$(".error_cl_nombre").text("");
		  	$(".error_cl_apellido_paterno").text("");
		  	$(".error_cl_correo").text("");
		    $(".error_cl_usuario").text("");
		  	$(".error_cl_telefono").text("");
		  	

			//validando que el correo se encuentre bien escrito
			var expreg_correo = /[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
			if(expreg_correo.test(cl_correo.trim())){
		  	 $(".error_cl_correo").html('');
		  	}else{
		  	 $(".error_cl_correo").html('El correo es incorrecto.');
		  	band = 2;
		  	}

		  	//validando que la contraseña se encuentre bien escrita
		  	if(cl_contrasenia.trim() != "" && cl_fcontrasenia.trim() != ""){
				var expreg_pass = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&#])([A-Za-z\d$@$!%*?&#]|[^ ]){6,10}$/c;
			  	if(expreg_pass.test(cl_contrasenia.trim())){
			        $(".error_cl_contrasenia").html('');
			    }else{
			        $(".error_cl_contrasenia").html('La contraseña debe contener 1 letra en mayúscula, 1 símbolo y 1 dígito numérico y sin espacios en una palabra de 6 a 10 letras.');
			  		band = 2;
			    }
			}
		    
		    //validando que la contraseña y confirmacion de contraseña coincidan
			if(cl_contrasenia.trim()!= cl_fcontrasenia.trim()){
		        $(".error_cl_fcontrasenia").html('La contraseña y la confirmación de contraseña son diferentes.');
		        band = 2;
		    }
		    
		    //validando que el nombre de usuario solo contenga letras y numeros 
		        var expreg_usuario =/^[a-z\d_]{5,20}$/i;
		        if(expreg_usuario.test(cl_usuario.trim())){
		            $(".error_cl_usuario").html('');
		        }else{
		            $(".error_cl_usuario").html('El nombre de usuario solo debe contener letras y números, con longitud de 5 a 15 caracteres.');
		            bad= 2;
		        }
		        
		    if(band==0){
		        $.ajax({
		            type: 'POST',
		            url:  '<?php echo base_url(); ?>cl_clientes/validar_cliente_editar_ajax',
		            data: $("#formulario_cliente").serialize(),
		            dataType: 'json',
		            success: function(resp) { 
		                //valida que no se repita el correo
		                if(resp.error_cl_correo==0){
		                    $(".error_cl_correo").html('');
		                }else{
		                    $(".error_cl_correo").html('El correo electrónico '+cl_correo.trim()+' ya ha sido registrado.');
		                }
		                //valida que no se repita el nombre de usuario
		                if(resp.error_cl_usuario==0){
		                    $(".error_cl_usuario").html('');
		                }else{
		                    $(".error_cl_usuario").html('El nombre de usuario '+cl_usuario.trim()+' ya ha sido registrado.');
		                }
		                //todo correcto entra a enviar el formulario
		                if( resp.error_cl_correo==0 && resp.error_cl_usuario==0){
		                    $.confirm({
								title: '¿Deseas editar el cliente: '+cl_nombre+' '+cl_apellido_paterno+'?',
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
						                $('#formulario_cliente').submit();
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
		        cl_nombre.trim() == "" && 
		        cl_apellido_paterno.trim() == "" && 
		        cl_correo.trim() == "" && 
		        cl_usuario.trim() == ""  &&
		        cl_telefono.trim() == ""
		    ){
		        $(".error_cl_nombre").text(req);
		        $(".error_cl_apellido_paterno").text(req);
		        $(".error_cl_correo").text(req);
		        $(".error_cl_usuario").text(req);
		        $(".error_cl_telefono").text(req);
		        return false;	
		    }
		    if (
		        cl_nombre.trim() == "" || 
		        cl_apellido_paterno.trim() == "" || 
		        cl_correo.trim() == "" || 
		        cl_usuario.trim() == ""  ||
		        cl_telefono.trim() == ""  
		    ){
		    if(cl_nombre.trim() == "")$(".error_cl_nombre").text(req);
		        else $(".error_cl_nombre").text("");

		    if(cl_apellido_paterno.trim() == "")$(".error_cl_apellido_paterno").text(req);
		        else $(".error_cl_apellido_paterno").text("");

		    if(cl_correo.trim() == "")$(".error_cl_correo").text(req);
		        else $(".error_cl_correo").text("");

		    if(cl_usuario.trim() == "")$(".error_cl_usuario").text(req);
		        else $(".error_cl_usuario").text("");

		    if(cl_telefono.trim() == "")$(".error_cl_telefono").text(req);
		        else $(".error_cl_telefono").text("");

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
							location.href='<?= base_url(); ?>cl_clientes';
						}
					},
				}
			});
		});
		</script>
	</body>
</html>