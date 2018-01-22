<!DOCTYPE html>
<html lang="en" class="no-js">
	<head>
		<title>MIA OFFICE - PANEL</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<meta content="" name="description" />
		<meta content="" name="author" />
		<link rel="stylesheet" href="<?= plugin_url(); ?>bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="<?= plugin_url(); ?>font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="<?= asset_url(); ?>fonts/style.css">
		<link rel="stylesheet" href="<?= css_url(); ?>main.css">
		<link rel="stylesheet" href="<?= css_url(); ?>main-responsive.css">
		<link rel="stylesheet" href="<?= plugin_url(); ?>iCheck/skins/all.css">
		<link rel="stylesheet" href="<?= plugin_url(); ?>bootstrap-colorpalette/css/bootstrap-colorpalette.css">
		<link rel="stylesheet" href="<?= plugin_url(); ?>perfect-scrollbar/src/perfect-scrollbar.css">
		<link rel="stylesheet" href="<?= css_url(); ?>theme_light.css" type="text/css" id="skin_color">
		<link rel="stylesheet" href="<?= plugin_url(); ?>fullcalendar/fullcalendar/fullcalendar.css">
		<link rel="stylesheet" href="<?= css_url(); ?>jquery-confirm.min.css">
		<link rel="stylesheet" href="<?= css_url(); ?>jquery.timepicker.min.css">

		<link rel="shortcut icon" href="favicon.ico" />
		<style>
		    #agregar-eventoModal .modal {
		      position: relative;
		      top: auto;
		      bottom: auto;
		      right: auto;
		      left: auto;
		      display: block;
		    }

		    #agregar-eventoModal .modal {
		      background: transparent !important;
		    }
	    </style>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
		<script src="<?= plugin_url(); ?>jquery-ui/jquery-ui-1.10.2.custom.min.js"></script>
		<script>
		$( document ).ready(function() {
			var $modal 		 = $('#agregar-eventoModal');
			var $modalEditar = $('#editar-eventoModal'); 
			var event = [];
			$.ajax({
	            type: 'POST',
			    url: '<?= base_url(); ?>calendario/getEventos',
			    dataType: 'json',
			    success: function(resp) {
			        $.each(resp, function(k,v){
			        	event.push({
			        		id: v.id_evento,
			            	title: v.ca_titulo,
				            start: v.ca_fecha_inicio,
				            end: v.ca_fecha_fin
				        });
				    });		            	              
			    
	        		var calendar = $('#calendar').fullCalendar({
	        			monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
						monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'],
						dayNames: ['Domingo','Lunes','Martes','Miércoles','Jueves','Viernes','Sábado'],
						dayNamesShort: ['Dom','Lun','Mar','Mié','Jue','Vie','Sáb'],
	            		buttonText: {
	                	prev: '<i class="fa fa-chevron-left"></i>',
	                	next: '<i class="fa fa-chevron-right"></i>'
	            		},
			            /*header: {
			                left: 'prev,next today',
			                center: 'title',
			                right: 'month,agendaWeek,agendaDay'
			            },*/
			            events: event,
			            selectable: true,
			            selectHelper: true,
			            select: function (start, end, allDay) {
			            	$modal.modal('show');

			            	$('#ca_fecha_inicio').val(dateFormat(start));
			            	$('#ca_fecha_fin').val(dateFormat(end));

			            	$('.guardar-evento').click(function(){
			            		if(validarEvento()){
			            			var title = $('#ca_titulo').val();
			            			$.ajax({
			            				type: 'POST',
							            url:  $("#formulario_evento").attr('action'),
							            data: $("#formulario_evento").serialize(),
							            dataType: 'json',
							            success: function(resp){
							            	if(resp){
							            		calendar.fullCalendar('renderEvent', {
							            			id: resp,
					                                title: title,
					                                start: start,
					                                end: end,
					                                allDay: allDay,
					                                //className: $categoryClass
					                            }, true); // make the event "stick"
					                            $("#formulario_evento")[0].reset();
			            						$modal.modal('hide');
							            	}else{

							            	}
							            }
			            			});
			            		}
			            	});
			            },
			            eventClick: function (calEvent, jsEvent, view) {
			            	$.ajax({
			            		type: 'POST',
							    url:  '<?= base_url(); ?>calendario/getEventoId',
							    data: 'id_evento='+calEvent._id,
							    dataType: 'json',
							    	success: function(resp){
							    		$('#ca_titulo_editar').val(resp.ca_titulo);
							    		$('#ca_id_oficina_editar option[value="'+resp.ca_id_oficina+'"]').attr("selected", "selected");
							    		$('#ca_horario_inicio_editar, .horarioInicioEditar').val(timeFormat(resp.ca_horario_inicio));
							    		$('#ca_horario_fin_editar, .horarioFinEditar').val(timeFormat(resp.ca_horario_fin));
							    		$modalEditar.modal('show');
							    		$('#id_evento_editar').val(resp.id_evento);
							    	}
			            		});
			            	$('.editar-evento').click(function(){
			            		calEvent.title = $('#ca_titulo_editar').val();
			            		$.ajax({
			            			type: 'POST',
							        url:  $("#formulario_editar_evento").attr('action'),
							        data: $("#formulario_editar_evento").serialize(),
							        dataType: 'json',
							        success: function(resp){
							        	if(resp){
							            	calendar.fullCalendar('updateEvent', calEvent);
			            					$modalEditar.modal('hide');
			            				}else{

			            				}
							        }
							    });
			            	});
			            	$('.eliminar-evento').click(function(){
			            		$.ajax({
			            			type: 'POST',
							        url:  '<?= base_url(); ?>calendario/eliminar_evento',
							        data: 'id_evento='+calEvent._id,
							        dataType: 'json',
							        success: function(resp){
							        	if(resp){
						            		calendar.fullCalendar('removeEvents', function (ev) {
						            			alert(calEvent.id);
						                        return (ev._id == calEvent._id);
			                    			});
			                    			$modalEditar.modal('hide');
			                    		}else{

			                    		}
			                    	}
			                    });
			            	});
			            }
		        	});
	        	}
			});
		});
        	
		</script>
	</head>
	<body>
		<div class="navbar navbar-inverse navbar-fixed-top">
			<div class="container">
				<div class="navbar-header">
					<button data-target=".navbar-collapse" data-toggle="collapse" class="navbar-toggle" type="button">
						<span class="clip-list-2"></span>
					</button>
					<a class="navbar-brand" href="<?= base_url(); ?>panel/inicio">
						MIA OFFICE
					</a>
				</div>
				<div class="navbar-tools">
					<ul class="nav navbar-right">
						<li class="dropdown current-user">
							<a class="username">Hola <?= $this->session->userdata('us_usuario'); ?></a>
						</li>
						<li>
							<a href="<?= base_url(); ?>administrador/destroy"><i class="fa fa-power-off"></i>
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<div class="main-container">
			<div class="navbar-content">
				<div class="main-navigation navbar-collapse collapse">
					<div class="navigation-toggler">
						<i class="clip-chevron-left"></i>
						<i class="clip-chevron-right"></i>
					</div>
					<ul class="main-navigation-menu">
						<li>
							<a href="<?= base_url(); ?>panel/inicio"><i class="clip-home-3"></i>
								<span class="title"> Inicio</span>
							</a>
						</li class="active open">
						<li>
							<a href="<?= base_url(); ?>us_usuarios"><i class="clip-user-2"></i>
								<span class="title"> Usuarios</span>
							</a>
						</li>
						<li>
							<a href="<?= base_url(); ?>cl_clientes"><i class="clip-users"></i>
								<span class="title"> Clientes</span>
							</a>
						</li>
						<li>
							<a href="<?= base_url(); ?>of_oficinas"><i class="fa fa-building-o"></i>
								<span class="title"> Oficinas</span>
							</a>
						</li>
						<li>
							<a href="<?= base_url(); ?>ub_ubicaciones"><i class="clip-location"></i>
								<span class="title"> Ubicaciones</span>
							</a>
						</li>
						<li class="active open">
							<a href="<?= base_url(); ?>calendario"><i class="clip-calendar"></i>
								<span class="title"> Calendario</span>
							</a>
						</li>
					</ul>
				</div>
			</div>
			<div class="main-content">
				<div class="container">
					<div class="row">
						<div class="col-sm-12">
							<ol class="breadcrumb">
								<li>
									<i class="clip-home-3"></i>
									<a>
										Inicio
									</a>
								</li>
								<li class="active">
									Calendario
								</li>
								<div class="page-header">
								</div>
							</ol>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<!-- start: FULL CALENDAR PANEL -->
							<div class="panel panel-default">
								<div class="panel-heading">
									<i class="fa fa-calendar"></i>
									Calendario
								</div>
								<div class="panel-body">
									<div class="col-sm-12">
										<div id="calendar"></div>
									</div>
								</div>
							</div>
							<!-- end: FULL CALENDAR PANEL -->
						</div>
					</div>
				</div>
			</div>
		</div>

		<div id="agregar-eventoModal" class="modal fade" tabindex="-1" data-width="760" style="display: none;">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="limpiarFomulario()">
							&times;
						</button>
						<h4 class="modal-title">Agregar Evento</h4>
					</div>
					<div class="modal-body">
						 <form id="formulario_evento" action="<?= base_url(); ?>calendario/ejecutar_registrar_evento" method="post" accept-charset="utf-8" enctype="multipart/form-data" autocomplete="off">
						<div class="row">
							<!-- Titulo -->
							<div class="col-sm-12">
								<label class="control-label">Titulo</label>
							    <input type="text" placeholder="titulo" name="ca_titulo" class="form-control" id="ca_titulo" required >
							    <span class="pull_center error_ca_titulo" style="color:red;"></span>
							</div>
							<!-- Oficina -->
							<div class="col-sm-12">
								<label class="control-label">Oficina</label>
							    <select class="form-control" name="ca_id_oficina" id="ca_id_oficina" required>
							    	<option value="0">Eligir Oficina</option>
							        <?php foreach($oficinas as $row): ?>
									<option value="<?= $row->of_id_oficina; ?>"><?= $row->of_nombre; ?></option>
							    	<?php endforeach; ?>
							    </select>
							    <span class="pull_center error_ca_id_oficina" style="color:red;"></span>
							</div>
							<!-- Horario Inicio -->
							<div class="col-sm-6">
								<label class="control-label">Horario Inicio</label>
							    <input type="text" class="form-control horarioInicio" onkeypress="return SoloNumeros(event);" />
							    <input type="hidden" name="ca_horario_inicio" id="ca_horario_inicio" value="">
							    <span class="pull_center error_ca_horario_inicio" style="color:red;"></span>
							</div>
							<!-- Horario Final -->
							<div class="col-sm-6">
							    <label class="control-label">Horario Final</label>
							    <input type="text" class="form-control horarioFin" onkeypress="return SoloNumeros(event);"  />
							    <input type="hidden" name="ca_horario_fin" id="ca_horario_fin" value=""  >
							    <span class="pull_center error_ca_horario_fin" style="color:red;"></span>
							</div>
						</div>
							<!-- Fecha Inicio, Fecha Final -->
							<input type="hidden" name="ca_fecha_inicio" id="ca_fecha_inicio">
							<input type="hidden" name="ca_fecha_fin" id="ca_fecha_fin">
						</form>
					</div>
					<div class="modal-footer">
						<button type="button" data-dismiss="modal" class="btn btn-light-grey" onclick="limpiarFomulario()">
							Cerrar
						</button>
						<button type='submit' class='btn btn-success guardar-evento'>
							<i class='fa fa-save'></i> Guardar
						</button>
					</div>
				</div>
			</div>
		</div>

		<div id="editar-eventoModal" class="modal fade" tabindex="-1" data-width="760" style="display: none;">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="limpiarFomulario()">
							&times;
						</button>
						<h4 class="modal-title">Editar Evento</h4>
					</div>
					<div class="modal-body">
						 <form id="formulario_editar_evento" action="<?= base_url(); ?>calendario/ejecutar_editar_evento" method="post" accept-charset="utf-8" enctype="multipart/form-data" autocomplete="off">
						
						<input type="hidden" name="id_evento_editar" id="id_evento_editar" >


						<div class="row">
							<!-- Titulo -->
							<div class="col-sm-12">
								<label class="control-label">Titulo</label>
							    <input type="text" placeholder="titulo" name="ca_titulo_editar" class="form-control" id="ca_titulo_editar" required >
							    <span class="pull_center error_ca_titulo_editar" style="color:red;"></span>
							</div>
							<!-- Oficina -->
							<div class="col-sm-12">
								<label class="control-label">Oficina</label>
							    <select class="form-control" name="ca_id_oficina_editar" id="ca_id_oficina_editar" required>
							    	<option value="0">Eligir Oficina</option>
							        <?php foreach($oficinas as $row): ?>
									<option value="<?= $row->of_id_oficina; ?>"><?= $row->of_nombre; ?></option>
							    	<?php endforeach; ?>
							    </select>
							    <span class="pull_center error_ca_id_oficina_editar" style="color:red;"></span>
							</div>
							<!-- Horario Inicio -->
							<div class="col-sm-6">
								<label class="control-label">Horario Inicio</label>
							    <input type="text" class="form-control horarioInicioEditar" onkeypress="return SoloNumeros(event);" />
							    <input type="hidden" name="ca_horario_inicio_editar" id="ca_horario_inicio_editar" value="">
							    <span class="pull_center error_ca_horario_inicio_editar" style="color:red;"></span>
							</div>
							<!-- Horario Final -->
							<div class="col-sm-6">
							    <label class="control-label">Horario Final</label>
							    <input type="text" class="form-control horarioFinEditar" onkeypress="return SoloNumeros(event);"  />
							    <input type="hidden" name="ca_horario_fin_editar" id="ca_horario_fin_editar" value="">
							    <span class="pull_center error_ca_horario_fin_editar" style="color:red;"></span>
							</div>
						</div>
						</form>
					</div>
					<div class="modal-footer">
						<button type="button" data-dismiss="modal" class="btn btn-light-grey" onclick="limpiarFomulario()">
							Cerrar
						</button>
						<button type="button" data-dismiss="modal" class="btn btn-red eliminar-evento">
							<i class="fa fa-trash"></i> Eliminar
						</button>
						<button type='submit' class='btn btn-success editar-evento'>
							<i class='fa fa-check'></i> Editar
						</button>
					</div>
				</div>
			</div>
		</div>

		<div class="footer clearfix">
			<div class="footer-inner">
				2018 &copy; MIA OFFICE.
			</div>
		</div>
		
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

		<script src="<?= plugin_url(); ?>flot/jquery.flot.js"></script>
		<script src="<?= plugin_url(); ?>flot/jquery.flot.pie.js"></script>
		<script src="<?= plugin_url(); ?>flot/jquery.flot.resize.min.js"></script>
		<script src="<?= plugin_url(); ?>jquery.sparkline/jquery.sparkline.js"></script>
		<script src="<?= plugin_url(); ?>jquery-easy-pie-chart/jquery.easy-pie-chart.js"></script>
		<script src="<?= plugin_url(); ?>jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>
		<script src="<?= plugin_url(); ?>fullcalendar/fullcalendar/fullcalendar.js"></script>
		<script src="<?= plugin_url(); ?>moment/min/moment.min.js"></script>
		<script src="<?= js_url(); ?>index.js"></script>
		<script src="<?= js_url(); ?>jquery-confirm.min.js"></script>
		<script src="<?= js_url(); ?>jquery.timepicker.min.js"></script>
		<script>
			jQuery(document).ready(function() {
				Main.init();
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


			/* Guardar la variable del horario de inicio para luego usarla */
			var horarioInicio = '';
			$('.horarioInicio').timepicker({
				timeFormat: 'G:i',
    			show2400: true,
				'minTime': '00:00',
				'maxTime': '24:00'
			});
			$('.horarioInicio').change(function(){
				horarioInicio = $(this).val();
				if(horarioInicio != ''){
					$('#ca_horario_inicio').val(horarioInicio);
					$('.horarioFin').timepicker({
						timeFormat: 'G:i',
    					show2400: true,
					    'minTime': horarioInicio,
					    'maxTime': '24:00'
					});
				}
			});

			$('.horarioFin').change(function(){
				var horarioFin = $(this).val();
				if(horarioFin != ''){
					$('#ca_horario_fin').val(horarioFin);
				}
			});
			/* Guardar la variable del horario de inicioEditar para luego usarla */
			var horarioInicioEditar = '';
			$('.horarioInicioEditar').timepicker({
				timeFormat: 'G:i',
    			show2400: true,
				'minTime': '00:00',
				'maxTime': '24:00'
			});
			$('.horarioInicioEditar').change(function(){
				horarioInicioEditar = $(this).val();
				if(horarioInicioEditar != ''){
					$('#ca_horario_inicio_editar').val(horarioInicioEditar);
					$('.horarioFinEditar').timepicker({
						timeFormat: 'G:i',
    					show2400: true,
					    'minTime': horarioInicioEditar,
					    'maxTime': '24:00'
					});
				}

			});

			
			$('.horarioFinEditar').change(function(){
				var horarioFinEditar = $(this).val();
				if(horarioFinEditar != ''){
					$('#ca_horario_fin_editar').val(horarioFinEditar);
				}
			});
			

			 function validarEvento(){
			 	ban = true;
			 	if($('#ca_titulo').val() == ''){
			 		$('.error_ca_titulo').html('*Requerido');
			 		ban = false;
			 	}else{
			 		$('.error_ca_titulo').html('');
			 	}
			 	if($('#ca_id_oficina').val() == 0){
			 		$('.error_ca_id_oficina').html('*Requerido');
			 		ban = false;
			 	}else{
			 		$('.error_ca_id_oficina').html('');
			 	}
			 	if($('#ca_horario_inicio').val() == ''){
			 		$('.error_ca_horario_inicio').html('*Requerido');
			 		ban = false;
			 	}else{
			 		$('.error_ca_horario_inicio').html('');
			 		if($('#ca_horario_fin').val() == ''){
				 		$('.error_ca_horario_fin').html('*Requerido');
				 		ban = false;
				 	}else{
				 		$('.error_ca_horario_fin').html('');
				 	}
			 	}
			 	return ban;
			 }

			 function limpiarFomulario(){
			 	$("#formulario_evento")[0].reset();
			 }

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
	<!-- end: BODY -->
</html>