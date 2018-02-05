<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Mia Office</title>
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
								<label>Oficina a reservar</label>
								<select id="re_id_oficina" class="form-control">
									<option value="0">Elegir</option>
									<?php foreach ($oficinas as $row): ?>
									<option value="<?= $row->of_id_oficina; ?>" oficina="<?= $row->of_nombre; ?>" precio="<?= $row->of_precio; ?>"><?= $row->of_nombre; ?></option>
									<?php endforeach; ?>
								</select>
							</div>
							<div class="col-md-12 calendario" style="display: none;">
								<label>Fecha de Reservación</label>
								<input type="text" readonly="readonly" class="form-control fechasDisponibles">
								<span class="mensaje" style="color:red;"></span>
							</div>
						</div>
						<div class="col-md-4">
							<div class="col-md-12 horario" style="display: none;">
								<label>Hora Inicio</label>
								<input type="text" class="form-control horaInicio">
							</div>
							<div class="col-md-12 cantidadHoras" style="display: none;">
							</div>
						</div>
						<div class="col-md-4">
							<h3>Detalle de la reservación</h3>
							<table>
								<tbody>
									<tr>
										<td class="oficina"></td>
									</tr>
									<tr>
										<td class="fecha_reserva"></td>
									</tr>
									<tr>
										<td class="hora_inicio"></td>
									</tr>
									<tr>
										<td class="hora_final"></td>
									</tr>
									<tr>
										<td class="cantidad_horas"></td>
									</tr>
									<tr>
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

			var re_id_oficina;
			var precio;
			var date = dateFormat(new Date());
			$('#re_id_oficina').change(function(){
				re_id_oficina = $(this).val();
				var oficina = $('#re_id_oficina option:selected').attr('oficina');
				precio = $('#re_id_oficina option:selected').attr('precio');
				if(re_id_oficina != 0){
					$('.calendario').show();
					$('.fechasDisponibles').datepicker({
						format: 'dd/mm/yyyy',
						language: 'es-Es',
						autoclose: true,
						startDate: date,
						orientation: 'bottom'
					});
					$('.oficina').html('<label>Oficina: '+oficina+'</label>');
					$('.precio_horas').html('<label>Precio X Hora: $'+precio+'</label>');
				}else{
					$('.calendario').hide();
					$('.horario').hide();
					$('.fechasDisponibles').val('');
					$('.mensaje').html('');
					$('.oficina').html('');
					$('.cantidadHoras').hide();
				}
			});

			$('.fechasDisponibles').change(function(){
				var fecha = $(this).val();
				
				if(fecha != ''){ 
					$.ajax({
						type: 'POST',
						url: '<?=base_url(); ?>sitio_web/getFechasDisponibles',
						data: 're_id_oficina='+re_id_oficina+'&re_fecha='+fecha,
						dataType: 'json',
						success: function(resp){
							if(resp.calendario == null){
								$('.mensaje').html('Lo sentimos no contamos con algún horario disponible');
								$('.horario').hide();
								$('.cantidadHoras').hide();
								$('.fecha_reserva').html('');
							}else{
								$('.fecha_reserva').html('<label>Fecha: '+fecha+'</label>');

								var horasReserva = [];
								$.each(resp.reservacion, function(k,v){
						        	horasReserva.push([timeFormat(v.re_hora_inicio), timeFormat(v.re_hora_fin)]);
							    });

								var horaInicio = timeFormat(resp.calendario.ca_hora_inicio);
								var horaFin = timeFormat(resp.calendario.ca_hora_fin);
								var numeroHoras = parseInt(horaFin) - parseInt(horaInicio);

								var i= 1;
								var option = '';
								for(i; i<=numeroHoras; i++){
									option += '<option value="'+i+'">'+i+'</option>';
								}

								$('.cantidadHoras').html(''+
									'<label>Cantidad de horas</label>'+
									'<select id="cant_hor" class="form-control" onchange="getTime();">'+
									'<option value="0">Elegir Nº Hora</option>'+
									option+
									'</select>');

								$('.cantidadHoras').show();

								$('.mensaje').html('');
								$('.horario').show();
								$('.horaInicio').html('');
								$('.horaInicio').timepicker({
									timeFormat: 'G:i',
									show2400: true,
									step: 60,
									'minTime': horaInicio,
									'maxTime': horaFin,
									'disableTimeRanges': horasReserva,

								});
								
							}

						}			
					});
				}
			});

		$('.horaInicio').change(function(){
			var horaInicio = $(this).val();
			$('.hora_inicio').html('<label>Hora Incio: '+horaInicio+'</label>');

		});

		function getTime(){
			var cantidadHoras = $('#cant_hor').val();
			var hora = $('.horaInicio').val();
			hora = hora.split(':');
			var horaInicio = hora[0]+':'+hora[1];
			var horaFin = parseFloat(hora[0])+parseInt(cantidadHoras);
			var precio_final = parseFloat(cantidadHoras) * parseFloat(precio);
			if(cantidadHoras != 0){	
				$('.hora_inicio').html('<label>Hora Incio: '+horaInicio+'</label>');
				$('.hora_final').html('<label>Hora Fin: '+horaFin+':'+hora[1]+'</label>');
				$('.cantidad_horas').html('<label>Nº Horas: '+cantidadHoras+'</label>');
				$('.precio_horas').html('<label>Precio X Hora: $'+precio_final+'</label>');
				$('.reservar').html('<button type="button" class="btn btn-success" onclick="reservar();">Reservar</button>');
			}else{
				$('.reservar').html('');
				$('.hora_inicio').html('<label>Hora Incio: '+horaInicio+'</label>');
				$('.hora_final').html('<label>Hora Fin: '+horaFin+':'+hora[1]+'</label>');
				$('.cantidad_horas').html('<label>Nº Horas: '+cantidadHoras+'</label>');
				$('.precio_horas').html('<label>Precio X Hora: $'+precio_final+'</label>');
			}
		}

		function reservar(){
			var fecha = $('.fechasDisponibles').val();
			var cliente = '<?= $cliente; ?>';
			var oficina = $('#re_id_oficina option:selected').attr('oficina');
			var cantidadHoras = $('#cant_hor').val();
			var hora = $('.horaInicio').val();
			hora = hora.split(':');
			var horaInicio = hora[0]+':'+hora[1];
			var horaFin = parseFloat(hora[0])+parseInt(cantidadHoras);
			horaFin = horaFin+':'+hora[1];
			var precio_final = parseFloat(cantidadHoras) * parseFloat(precio);

			$.confirm({
		        title: 'Resumen de la reservación',
		        theme: 'material',
		        type: 'blue',
		        content: ''+
		          '<form id="formulario_reservacion" action="<?= base_url(); ?>sitio_web/agregar_reservación" method="POST" accept-charset="utf-8" enctype="multipart/form-data" autocomplete="off">' +
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
				          '<label>Nº Hora(s): '+cantidadHoras+'</label>' +
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
		            		data: 're_fecha='+fecha+'&re_hora_inicio='+horaInicio+'&re_hora_fin='+horaFin+'&re_id_cliente='+cliente+'&re_id_oficina='+re_id_oficina+'&re_precio='+precio_final,
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
		}

		

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
