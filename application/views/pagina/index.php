<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Quadra Towers</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<meta content="" name="description" />
		<meta content="" name="author" />
		<link href="<?= asset_url(); ?>sitio_web/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
		<link rel="stylesheet" href="<?= asset_url(); ?>sitio_web/plugins/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="<?= asset_url(); ?>sitio_web/fonts/style.css">
		<link rel="stylesheet" href="<?= asset_url(); ?>sitio_web/plugins/animate.css/animate.min.css">
		<link rel="stylesheet" href="<?= asset_url(); ?>sitio_web/css/main.css">
		<link rel="stylesheet" href="<?= asset_url(); ?>sitio_web/css/main-responsive.css">
		<link rel="stylesheet" href="<?= asset_url(); ?>sitio_web/css/theme_blue.css" type="text/css" id="skin_color">
		<link rel="stylesheet" href="<?= asset_url(); ?>sitio_web/plugins/revolution_slider/rs-plugin/css/settings.css">
		<link rel="stylesheet" href="<?= asset_url(); ?>sitio_web/plugins/flex-slider/flexslider.css">
		<link rel="stylesheet" href="<?= asset_url(); ?>sitio_web/plugins/colorbox/example2/colorbox.css">
		<link rel="stylesheet" href="<?= css_url(); ?>jquery-confirm.min.css">
		<link rel="stylesheet" href="<?= plugin_url(); ?>datepicker/css/bootstrap-datepicker.min.css">
		<link rel="stylesheet" href="<?= plugin_url(); ?>clockpicker/dist/bootstrap-clockpicker.min.css">
		<link rel="stylesheet" href="<?= plugin_url(); ?>datepicker/css/cangas.datepicker.css">
		<link rel="stylesheet" href="<?= css_url(); ?>jquery.timepicker.min.css">
	</head>
	<body>
		<header>
			<div class="clearfix " id="topbar">
				<div class="container">
					<div class="row">
						<div class="col-sm-6">
							<div class="callus">
								Contactanos: (641)-734-4763 - Correo:
								<a href="mailto:contacto@miaoffice.com">
									contacto@miaoffice.com
								</a>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="social-icons">
								<ul>
									<?php if($this->session->userdata('cl_sesion_activa') == false){ 
										$tipo_invitado = 'Invitado';
										$cliente = 0;
									?>
									<li class="fa fa-sign-in fa-3x tooltips login" data-original-title="Ingresar" data-placement="bottom">
									</li>
									<?php }else{ 
										$tipo_invitado = 'Hola '.$this->session->userdata('cl_usuario');
										$cliente = $this->session->userdata('cl_id_cliente');
									?>
									<a href="<?= base_url(); ?>sitio_web/cerrar_sesion">
									<li class="fa fa-sign-out fa-3x tooltips" data-original-title="Cerrar Sesión" data-placement="bottom">
									</li>
									</a>
									<?php } ?>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div role="navigation" class="navbar navbar-default navbar-fixed-top space-top">
				<div class="container">
					<div class="navbar-header">
						<a class="navbar-brand" href="index.html">
							MIA OFFICE
						</a>
					</div>
					<div class="navbar-collapse collapse">
						<ul class="nav navbar-nav navbar-right">
							<li class="active">
								<a href="<?= base_url(); ?>">
									Reservaciones
								</a>
							</li>
							<li class="menu-search">
								<i class="fa fa-user"></i> <?= $tipo_invitado; ?>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</header>
		<div class="main-container">
			<section class="wrapper wrapper-grey padding50">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<h3>Haz tu reservación</h3>
						</div>
						<div class="col-md-4">
							<div class="col-md-12">
								<label>Ubicación donde se desea reservar</label>
								<select class="form-control re_id_ubicacion">
									<option value="0">Elegir ubicación</option>
									<?php foreach ($ubicaciones as $row): ?>
									<option value="<?= $row->ub_id_ubicacion; ?>" ubicacion="<?= $row->ub_nombre; ?>"><?= $row->ub_nombre; ?></option>
									<?php endforeach; ?>
								</select>
							</div>
							<div class="col-md-12">
								<label>Espacio a reservar</label>
								<select class="form-control re_id_oficina">
									<option value="0">Elegir espacio</option>
								</select>
							</div>
							<div class="col-md-12 calendario">
								<label>Fecha de Reservación</label>
								<input type="text" class="form-control fechasDisponibles" data-inputmask="'mask': '99/99/9999'" placeholder="dd/mm/yyyy" >
								<span class="mensaje" style="color:red;"></span>
							</div>
						</div>
						<div class="col-md-4">
							<div class="col-md-12">
								<label>Duración del evento</label>
								<select class="form-control dura_horas">
									<option value="">Duración del evento</option>
								</select>
							</div>
							<div class="col-md-12">
								<label>Horario</label>
								<select class="form-control horario">
									<option value="0">Elegir un horario</option>
								</select>
							</div>

							<div class="col-md-12 form-group">
								<button type="button" class="btn btn-success btn-reservar" style="margin-top: 1.6em; display: none;">Reservar</button>
							</div>
						</div>
						<div class="col-md-4">
							<h3>Detalle de la reservación</h3>
							<table id="example">
								<tbody>
									<tr>
										<td>Ubicación: </td>
										<td class="ubicacion"></td>
									</tr>
									<tr>
										<td>Espacio: </td>
										<td class="oficina"></td>
									</tr>
									<tr>
										<td>Fecha: </td>
										<td class="fecha_reserva"></td>
									</tr>
									<tr>
										<td>Nº Horas: </td>
										<td class="cantidad_horas"></td>
									</tr>
									<tr>
										<td>Hora Inicio: </td>
										<td class="hora_inicio"></td>
									</tr>
									<tr>
										<td>Hora Final: </td>
										<td class="hora_final"></td>
									</tr>
									<tr>
										<td>Precio x Hora: </td>
										<td class="precio_horas"></td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="col-xs-4 reservar"></div>
					</div>
				</div>
			</section>
		</div>
		<footer id="footer">
			<div class="container">
			</div>
			<div class="footer-copyright">
				<div class="container"></div>
			</div>
		</footer>
		<a id="scroll-top" href="#"><i class="fa fa-angle-up"></i></a>

		<div id="loginClienteModal" class="modal fade" tabindex="-1" data-width="760" style="display: none;">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="limpiarFomulario()">
							&times;
						</button>
						<h4 class="modal-title">Iniciar Sesión</h4>
					</div>
					<div class="modal-body">
						<form id="form_login_cliente" action="<?= base_url(); ?>sitio_web/login_cliente" action="POST" autocomplete="off" accept-charset="utf-8" enctype="multipart/form-data">

						<div class="row">
							<div class="form-group">
							   	<label>Usuario</label>
							    <input type="text" placeholder="Usuario" class="form-control cl_usuario" name="cl_usuario" required />
							    <span class="pull-center error_cl_usuario" style="color:red"></span>
							</div>
							<div class="form-group">
								<label>Contraseña</label>
							    <input type="password" placeholder="Contraseña" class="form-control cl_contrasenia" name="cl_contrasenia" required />
							    <span class="pull-center error_cl_contrasenia" style="color:red"></span>
							</div>
						</div>
						</form>
					</div>
					<div class="modal-footer">
						<button type="button" data-dismiss="modal" class="btn btn-light-grey" onclick="limpiarFomulario()">
							Cerrar
						</button>
						<button type='submit' class='btn btn-success iniciar_sesion'>
							<i class='fa fa-sign-in'></i> Iniciar Sesión
						</button>
					</div>
				</div>
			</div>
		</div>

		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
		<script src="<?= asset_url(); ?>sitio_web/plugins/bootstrap/js/bootstrap.min.js"></script>
		<script src="<?= asset_url(); ?>sitio_web/plugins/jquery.transit/jquery.transit.js"></script>
		<script src="<?= asset_url(); ?>sitio_web/plugins/hover-dropdown/twitter-bootstrap-hover-dropdown.min.js"></script>
		<script src="<?= asset_url(); ?>sitio_web/plugins/jquery.appear/jquery.appear.js"></script>
		<script src="<?= asset_url(); ?>sitio_web/plugins/blockUI/jquery.blockUI.js"></script>
		<script src="<?= asset_url(); ?>sitio_web/plugins/jquery-cookie/jquery.cookie.js"></script>
		<script src="<?= asset_url(); ?>sitio_web/js/main.js"></script>
		<script src="<?= asset_url(); ?>sitio_web/plugins/revolution_slider/rs-plugin/js/jquery.themepunch.plugins.min.js"></script>
		<script src="<?= asset_url(); ?>sitio_web/plugins/revolution_slider/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
		<script src="<?= asset_url(); ?>sitio_web/plugins/flex-slider/jquery.flexslider.js"></script>
		<script src="<?= asset_url(); ?>sitio_web/plugins/stellar.js/jquery.stellar.min.js"></script>
		<script src="<?= asset_url(); ?>sitio_web/plugins/colorbox/jquery.colorbox-min.js"></script>
		<script src="<?= asset_url(); ?>sitio_web/js/index.js"></script>
		<script src="<?= js_url(); ?>jquery-confirm.min.js"></script>
		<script src="<?= plugin_url(); ?>moment/moment.js"></script>
		<script src="<?= plugin_url(); ?>datepicker/js/bootstrap-datepicker.min.js"></script>
		<script src="<?= plugin_url(); ?>clockpicker/dist/bootstrap-clockpicker.min.js"></script>
		<script src="<?= plugin_url();?>input-mask/jquery.inputmask.js"></script>
		<script src="<?= plugin_url();?>input-mask/jquery.inputmask.date.extensions.js"></script>
		<script src="<?= plugin_url();?>input-mask/jquery.inputmask.extensions.js"></script>		
		<script src="<?= js_url(); ?>jquery.timepicker.min.js"></script>
		<script>
			jQuery(document).ready(function() {
				Main.init();
				Index.init();
				$.stellar();
			});
		</script>
		<script>
			/* Métodos para iniciar sesión*/
			$('.login').click(function(){
				$('#loginClienteModal').modal('show');
			});

			function validarSesion(){
				var ban = true;
				if($('.cl_usuario').val() == ''){
					$('.error_cl_usuario').html('*Requerido');
					ban = false;
				}else{
					$('.error_cl_usuario').html('');
				}

				if($('.cl_contrasenia').val() == ''){
					$('.error_cl_contrasenia').html('*Requerido');
					ban = false;
				}else{
					$('.error_cl_contrasenia').html('');
				}

				return ban;
			}
			$('.iniciar_sesion').click(function(){
				if(validarSesion()){
					$.ajax({
						type: 'POST',
						url: '<?= base_url(); ?>sitio_web/validar_usuario_ajax',
						data: $('#form_login_cliente').serialize(),
						dataType: 'json',
						success: function(resp){
							if(resp.error_cl_usuario == 1){
								$('.error_cl_usuario').html('El usuario '+$('.cl_usuario').val()+' no existe');
							}if(resp.error_cl_contrasenia == 1){
								$('.error_cl_contrasenia').html('la contraseña es incorrecta');
							}
							if(resp.error_cl_usuario == 0 && resp.error_cl_contrasenia == 0){
								location.href= $('#form_login_cliente').attr('action')+'/'+$('.cl_usuario').val();
							}
						}
					});
				}
			});
		</script>
		<script>

			$.fn.datepicker.dates['es'] = {
	          days: ["Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sábado"],
	          daysShort: ["Dom", "Lun", "Mar", "Mie", "Jue", "Vie", "Sáb"],
	          daysMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"],
	          months: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
	          monthsShort: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"],
	      	};
	      	var date = dateFormat(new Date());
	      	//Datemask dd/mm/yyyy
    		$(".fechasDisponibles").inputmask("dd/mm/yyyy");
	      	$('.fechasDisponibles').datepicker({
				format: 'dd/mm/yyyy',
				language: 'es-Es',
				autoclose: true,
				startDate: date,
				orientation: 'bottom'
			});

			$('.re_id_ubicacion').change(function(){
				var re_id_ubicacion = $(this).val();
				var ubicacion = $('.re_id_ubicacion option:selected').attr('ubicacion');

				if(re_id_ubicacion != 0){
					$('.ubicacion').html(ubicacion);
					$.ajax({
						type: 'post',
						url: '<?= base_url(); ?>sitio_web/getEspacios',
						data: 're_id_ubicacion='+re_id_ubicacion,
						dataType: 'json',
						success: function(resp){
							$('.re_id_oficina').html('<option value="0">Elegir espacio</option>');
							$.each(resp, function(k,v){
								$('.re_id_oficina').append('<option value="'+v.of_id_oficina+'" oficina="'+v.of_nombre+'" precio="'+v.of_precio+'">'+v.of_nombre+'</option>');
							});
						}
					});
				}else{
					$('.re_id_oficina').html('<option value="0">Elegir espacio</option>');
					$('.ubicacion').html('');
				}
			});

			$('.re_id_oficina').change(function(){
				var re_id_oficina = $(this).val();
				var oficina = $('.re_id_oficina option:selected').attr('oficina');
				if(re_id_oficina != 0){
					$('.oficina').html(oficina);
				}else{
					$('.oficina').html('');
				}	
			});
			

			$('.fechasDisponibles').change(function(){
				var fecha = $(this).val();
				var re_id_ubicacion = $('.re_id_ubicacion').val();
				var re_id_oficina = $('.re_id_oficina').val();
				
				if(re_id_ubicacion != 0){
					if(re_id_oficina != 0){
						if(fecha != ''){ 
							$.ajax({
								type: 'POST',
								url: '<?=base_url(); ?>sitio_web/getFechasDisponibles',
								data: 're_id_ubicacion='+re_id_ubicacion+'&re_id_oficina='+re_id_oficina+'&re_fecha='+fecha,
								dataType: 'json',
								success: function(resp){
									if(resp.c == null){
										$('.mensaje').html('Lo sentimos no contamos con algún horario disponible');
										$('.fecha_reserva').html('');
									}else{
										$('.fecha_reserva').html(fecha);
										$('.mensaje').html('');
										var horaIni = timeFormat(resp.c.ca_hora_inicio);
										horaIni = horaIni.split(':');
										var horaFin = timeFormat(resp.c.ca_hora_fin);
										horaFin = horaFin.split(':');
										var numeroHoras = parseFloat(horaFin[0])-parseFloat(horaIni[0]);
										var i= 1;
										$('.dura_horas').html('<option value="0">Duración del evento</option>');	
										for(i; i<=numeroHoras; i++){
											$('.dura_horas').append('<option value="'+i+'">'+i+'</option>');
										}
										
									}

								}			
							});
						}
					}else{
						$.alert({
							title: 'Favor de seleccionar un espacio',
				        	theme: 'modern',
				        	icon: 'fa fa-exclamation-circle',
	          				animation: 'scale',
				        	type: 'red',
				        	content: '',
				        	buttons: {
					          ok: {
					            text: 'Aceptar',
					            btnClass: 'btn-blue',
					            action: function () {
					            	$('.fechasDisponibles').val('');
					            }
					          }
					        }
			    		});
					}
				}else{
					$.alert({
							title: 'Favor de seleccionar una ubicación',
				        	theme: 'modern',
				        	icon: 'fa fa-exclamation-circle',
	          				animation: 'scale',
				        	type: 'red',
				        	content: '',
				        	buttons: {
					          ok: {
					            text: 'Aceptar',
					            btnClass: 'btn-blue',
					            action: function () {
					            	$('.fechasDisponibles').val('');
					            }
					          }
					        }
			    		});
				}
			});

			$('.dura_horas').change(function(){
				var fecha = $('.fechasDisponibles').val();
				var re_id_ubicacion = $('.re_id_ubicacion').val();
				var re_id_oficina = $('.re_id_oficina').val();
				var dura_horas = $('.dura_horas').val();

				if(dura_horas != 0){
					$('.cantidad_horas').html(dura_horas+' hr(s)');
					$('.hora_inicio').html('');
					$('.hora_final').html('');
					$.ajax({
						type: 'POST',
						url: '<?=base_url(); ?>sitio_web/getFechasDisponibles',
						data: 're_id_ubicacion='+re_id_ubicacion+'&re_id_oficina='+re_id_oficina+'&re_fecha='+fecha,
						dataType: 'json',
						success: function(resp){
							var horaIni = timeFormat(resp.c.ca_hora_inicio);
							horaIni = horaIni.split(':');
							var horaFin = timeFormat(resp.c.ca_hora_fin);
							horaFin = horaFin.split(':');

							var horaR = [];
							$.each(resp.r, function(k,v){
								var horaIniR = timeFormat(v.re_hora_inicio);
								horaIniR = horaIniR.split(':');
								var horaFinR = timeFormat(v.re_hora_fin);
								horaFinR = horaFinR.split(':');
								horaR.push(horaIniR[0], horaFinR[0]);
								
							});

							console.log(horaR);


							$('.horario').html('<option value="0">Elegir un horario</option>');
								for(horaIni[0]; horaIni[0]<horaFin[0]; horaIni[0]=parseFloat(horaIni[0])+parseFloat(dura_horas)){

									$('.horario').append('<option value="'+horaIni[0]+':'+horaIni[1]+'">'+horaIni[0]+':'+horaIni[1]+'</option>');
							}
						}
					});
				}else{
					$('.cantidad_horas').html('');
				}
			});

			$('.horario').change(function(){
				var horaIni = $(this).val(); 
				var dura_horas = $('.dura_horas').val();
				var precio = $('.re_id_oficina option:selected').attr('precio');
				horaIni = horaIni.split(':');
				if(horaIni != 0){
					$('.hora_inicio').html(horaIni[0]+':'+horaIni[1]);
					var horaFin = parseFloat(horaIni[0])+parseFloat(dura_horas)+':'+horaIni[1];

					$('.hora_final').html(horaFin);
					var precio_horas = parseFloat(precio)*parseFloat(dura_horas);
					$('.precio_horas').html('$'+precio_horas);
					$('.btn-reservar').css('display', 'block');
				}else{
					$('.hora_inicio').html('');
					$('.hora_final').html('');
					$('.precio_horas').html('');
					$('.btn-reservar').css('display', 'none');
				}
			});

		$('.btn-reservar').click(function(){
			var re_id_ubicacion = $('.re_id_ubicacion').val();
			var ubicacion 		= $('.re_id_ubicacion option:selected').attr('ubicacion');
			var re_id_oficina   = $('.re_id_oficina').val();
			var oficina 		= $('.re_id_oficina option:selected').attr('oficina');
			var fecha 			= $('.fechasDisponibles').val();
			var dura_horas 		= $('.dura_horas').val();
			var precio 			= $('.re_id_oficina option:selected').attr('precio');
			var hora 			= $('.horario').val(); 
			hora 				= hora.split(':');
			var cliente 		= '<?= $cliente; ?>';
			var horaInicio 		= hora[0]+':'+hora[1];
			var horaFin 		= parseFloat(hora[0])+parseFloat(dura_horas)+':'+hora[1];
			var precio_final 	= parseFloat(precio)*parseFloat(dura_horas);

			$.confirm({
		        title: 'Resumen de la reservación',
		        theme: 'material',
		        type: 'blue',
		        content: ''+
		          '<form id="formulario_reservacion" action="<?= base_url(); ?>sitio_web/agregar_reservación" method="POST" accept-charset="utf-8" enctype="multipart/form-data" autocomplete="off">' +
		          '<div class="form-group">'+
				    	'<label>Oficina: '+ubicacion+'</label>' +
				    '</div>'+
		          	'<div class="form-group">'+
				    	'<label>Oficina: '+oficina+'</label>' +
				    '</div>'+
				    '<div class="form-group">'+
				          '<label>Fecha: '+fecha+'</label>' +
				    '</div>'+
				    '<div class="form-group">'+
				          '<label>Hora Inicio: '+horaInicio+'</label>' +
				    '</div>'+
				    '<div class="form-group">'+
				          '<label>Hora Fin: '+horaFin+'</label>' +
				    '</div>'+
				    '<div class="form-group">'+
				          '<label>Nº Hora(s): '+dura_horas+'</label>' +
				    '</div>'+
				    '<div class="form-group">'+
				          '<label>Precio x Hora(s): $'+precio_final+'</label>' +
				    '</div>'+
				    '<div class="form-group">'+
				          '<label>¿Seguro que quiere hacer la reservación?</label>' +
				    '</div>'+
		          '</form>',
		        buttons: {
		          reservar: {
		            text: 'si',
		            btnClass: 'btn-green',
		            action: function () {
		            	$.ajax({
		            		type: 'POST',
		            		url: '<?= base_url(); ?>sitio_web/agregar_reservacion',
		            		data: 're_id_ubicacion='+re_id_ubicacion+'&re_id_oficina='+re_id_oficina+'&re_fecha='+fecha+'&re_hora_inicio='+horaInicio+'&re_hora_fin='+horaFin+'&re_id_cliente='+cliente+'&re_precio='+precio_final,
		            		dataType: 'json',
		            		success: function(resp){
		            			if(resp == 1){
		            				location.href='<?= base_url(); ?>sitio_web';
		            			}else{
		            				alert('Ocurrio un error');
		            			}
		            		}
		            	});
		            }
		          },
		          cancelar: {
		            text: 'no',
		            btnClass: 'btn-red pull-left',
		            action: function () {
		            }
		          }
		        }
		    });
		});

		function dateFormat( df ) {
			    var date  = new Date( df );
			    var day   = date.getDate();
			    if(day < 10){
			    	day = '0'+day;
			    }
			    var month = date.getMonth() + 1;
			    if(month < 10){
			    	month = '0'+month;
			    }
			    var year  = date.getFullYear();
			    return day + '/' + month + '/' + year;
			}

		function timeFormat (tf){
				var time = tf.split(":");
				var hour = time[0];
				var minutes = time[1];

				return hour+':'+minutes;
			}

		function limpiarFomulario(){
			 	$("#form_login_cliente")[0].reset();
			 }
		</script>
	</body>
</html>
