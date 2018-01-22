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
		<link rel="stylesheet" href="<?= css_url(); ?>jquery-confirm.min.css">
		<link rel="shortcut icon" href="favicon.ico" />
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
						</li>
						<li>
							<a href="<?= base_url(); ?>us_usuarios"><i class="clip-user-2"></i>
								<span class="title"> Usuarios</span>
							</a>
						</li>
						<li class="active open">
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
						<li>
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
									Clientes
								</li>
							</ol>
							<div class="page-header">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-12">
							<?php if($this->session->userdata('us_nivel_usuario') == 'Administrador') { ?>
							
							<a href="<?= base_url(); ?>cl_clientes/agregar_cliente">
							<button type="button" class="btn btn-light-grey">
								<i class="clip-plus-circle-2"></i> Cliente
							</button>
							</a>
							<?php } ?>
						</div>
					</div>
					<div class="row">
					 	<div class="pull-right">
					 		<label class="radio-inline">
							<input type="radio" class="check_filtro_1 flat-teal" value="1" 
							<?php if($status == 1){ echo "checked"; } ?> name="check_filtro">
							Activos
							</label>
							<label class="radio-inline">
							<input type="radio" class="check_filtro_2 flat-teal"  value="2" 
							<?php if($status == 2){ echo "checked"; } ?> name="check_filtro">
							Inactivos
							</label>
				    	</div>
					</div>
					<div class="row">
						<div class="panel-body">
							<div class="table-responsive">
								<table class="table table-bordered table-hover" id="sample-table-1">
									<thead>
										<tr>
											<th>ID</th>
											<th>Usuario</th>
											<th>Cliente</th>
											<th>Correo</th>
											<th>Telefono</th>
											<th>Status</th>
											<?php if($this->session->userdata('us_nivel_usuario') == 'Administrador') { ?>
											<th>Action</th>
											<?php } ?>
										</tr>
									</thead>
									<tbody>
									<?php foreach ($clientes as $row): ?>
										<tr>
											<td><?= $row->cl_id_cliente; ?></td>
											<td><?= $row->cl_usuario; ?></td>
											<td><?= $row->cl_nombre.' '.$row->cl_apellido_paterno; ?></td>
											<td><?= $row->cl_correo; ?></td>
											<td><?= $row->cl_telefono; ?></td>
											<td><?= $row->cl_status==1?"Activo":"Inactivo";?></td>
											<td>
												<?php if($this->session->userdata('us_nivel_usuario') == 'Administrador') {
													if($status == 1){
												 ?>
												<a href="<?= base_url(); ?>cl_clientes/editar_cliente/<?= $row->cl_id_cliente ?>">
												<button type="button" class="btn btn-xs btn-teal tooltips" data-placement="top" data-original-title="Editar Cliente">
													<i class="fa fa-edit"></i>
												</button>
												</a>
												<button type="button" class="btn btn-xs btn-red tooltips status_cliente" attrid="<?= $row->cl_id_cliente; ?>" attrstatus="<?= $row->cl_status; ?>" data-placement="top" data-original-title="Eliminar Cliente">
													<i class="fa fa-trash"></i>
												</button>
												<?php }else{ ?>
												<button type="button" class="btn btn-xs btn-primary tooltips status_cliente" attrid="<?= $row->cl_id_cliente; ?>" attrstatus="<?= $row->cl_status; ?>" data-placement="top" data-original-title="Reactivar Cliente">
													<i class="fa fa-check-circle"></i>
												<?php }
												} ?>
											</td>
										</tr>
									<?php endforeach; ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="footer clearfix">
			<div class="footer-inner">
				2018 &copy; MIA OFFICE.
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

		<script src="<?= plugin_url(); ?>flot/jquery.flot.js"></script>
		<script src="<?= plugin_url(); ?>flot/jquery.flot.pie.js"></script>
		<script src="<?= plugin_url(); ?>flot/jquery.flot.resize.min.js"></script>
		<script src="<?= plugin_url(); ?>jquery.sparkline/jquery.sparkline.js"></script>
		<script src="<?= plugin_url(); ?>jquery-easy-pie-chart/jquery.easy-pie-chart.js"></script>
		<script src="<?= plugin_url(); ?>jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>
		<script src="<?= plugin_url(); ?>fullcalendar/fullcalendar/fullcalendar.js"></script>
		<script src="<?= js_url(); ?>index.js"></script>
		<script src="<?= js_url(); ?>jquery-confirm.min.js"></script>
		<script>
			jQuery(document).ready(function() {
				Main.init();
				Index.init();
			});
		</script>
		<script>
			$('.check_filtro_1').on('ifChecked', function (){
			    var valor = $('.check_filtro_1').val();
			    location.href='<?php echo base_url();?>cl_clientes/cl_listado/'+valor;
		    });
		    $('.check_filtro_2').on('ifChecked', function (){
			    var valor = $('.check_filtro_2').val();
			    location.href='<?php echo base_url();?>cl_clientes/cl_listado/'+valor;
		    });

			$('.status_cliente').click(function(){
				var cl_id_cliente = $(this).attr('attrid');
				var estado	 	  = $(this).attr('attrstatus');
				var cl_status, mensaje;
				if(estado == 1){
					cl_status = 0;
					mensaje = '¿Deseas eliminar el registro?';
				}
				if(estado == 0){
					cl_status = 1;
					mensaje = '¿Deseas activar el registro?';
				}
				$.confirm({
					title:  mensaje,
          			theme: 'modern',
					closeIconClass: 'fa fa-close',
					icon: 'fa fa-exclamation-circle',
					animation: 'scale',
					type: 'red',
					content: '',
					buttons: {
						formSubmit: {
							text: 'Si',
						    btnClass: 'btn-green',
						    action: function () {
						    	$.ajax({
						    		type: 'POST',
						    		url: '<?= base_url(); ?>cl_clientes/cambiar_status_cliente',
						    		data: 'cl_id_cliente='+cl_id_cliente+'&cl_status='+cl_status,
						    		dataType: 'json',
						    		success: function(resp){
						    			if(resp == true){
						    				location.href='<?= base_url(); ?>cl_clientes'
						    			}
						    		}
						    	});
						    }
						},
						Cancel: {
							text: 'No',
						    btnClass: 'btn-red',
						    action: function () {
						    	//close
						    }
						},
					}
				});
			});
		</script>
	</body>
	<!-- end: BODY -->
</html>