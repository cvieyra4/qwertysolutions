<!DOCTYPE html>
<html lang="en" class="no-js">
	<head>
		<title>QUADRA TOWERS - PANEL</title>
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
						Quadra Towers Renta de Espacios
					</a>
				</div>
				<div class="navbar-tools">
					<ul class="nav navbar-right">
						<li class="dropdown current-user">
							<a class="username">Hola <?= $this->session->userdata('us_usuario'); ?></a>
						</li>
						<li>
							<a href="<?= base_url(); ?>administrador/sitio_web"><i class="fa fa-globe"></i>
							</a>
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
						<li >
							<a href="<?= base_url(); ?>us_usuarios"><i class="clip-user-2"></i>
								<span class="title"> Usuarios</span>
							</a>
						</li>
						<li>
							<a href="<?= base_url(); ?>ub_ubicaciones"><i class="clip-location"></i>
								<span class="title"> Direcciones</span>
							</a>
						</li>
						<li class="active open">
							<a href="<?= base_url(); ?>of_oficinas"><i class="fa fa-building-o"></i>
								<span class="title"> Espacios</span>
							</a>
						</li>
						<li>
							<a href="<?= base_url(); ?>calendario"><i class="clip-calendar"></i>
								<span class="title"> Calendario</span>
							</a>
						</li>
						<li>
							<a href="<?= base_url(); ?>cl_clientes"><i class="clip-users"></i>
								<span class="title"> Clientes</span>
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
									Oficinas
								</li>
							</ol>
							<div class="page-header">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-12">
							<?php if($this->session->userdata('us_nivel_usuario') == 'Administrador') { ?>
							
							<a href="<?= base_url(); ?>of_oficinas/agregar_oficina">
							<button type="button" class="btn btn-light-grey">
								<i class="clip-plus-circle-2"></i> Espacio
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
											<th>Nombre de espacio</th>
											<th>Precio</th>
											<th>Ubicación</th>
											<th>Estatus</th>
											<?php if($this->session->userdata('us_nivel_usuario') == 'Administrador') { ?>
											<th>Acción</th>
											<?php } ?>
										</tr>
									</thead>
									<tbody>
									<?php foreach ($oficinas as $row): ?>
										<tr>
											<td><?= $row->of_id_oficina; ?></td>
											<td><?= $row->of_nombre; ?></td>
											<td>$<?= number_format($row->of_precio,2,'.',','); ?></td>
											<td><?= $row->ub_nombre; ?></td>
											<td><?= $row->of_status==1?"Activo":"Inactivo";?></td>
											<td>
												<?php if($this->session->userdata('us_nivel_usuario') == 'Administrador') {
													if($status == 1){
												 ?>
												<a href="<?= base_url(); ?>of_oficinas/editar_oficina/<?= $row->of_id_oficina ?>">
												<button type="button" class="btn btn-xs btn-teal tooltips" data-placement="top" data-original-title="Editar Oficina">
													<i class="fa fa-edit"></i>
												</button>
												</a>
												<button type="button" class="btn btn-xs btn-red tooltips status_oficina" attrid="<?= $row->of_id_oficina; ?>" attrstatus="<?= $row->of_status; ?>" data-placement="top" data-original-title="Eliminar Oficina">
													<i class="fa fa-trash"></i>
												</button>
												<?php }else{ ?>
												<button type="button" class="btn btn-xs btn-primary tooltips status_oficina" attrid="<?= $row->of_id_oficina; ?>" attrstatus="<?= $row->of_status; ?>" data-placement="top" data-original-title="Reactivar Oficina">
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
			    location.href='<?php echo base_url();?>of_oficinas/of_listado/'+valor;
		    });
		    $('.check_filtro_2').on('ifChecked', function (){
			    var valor = $('.check_filtro_2').val();
			    location.href='<?php echo base_url();?>of_oficinas/of_listado/'+valor;
		    });

			$('.status_oficina').click(function(){
				var of_id_oficina = $(this).attr('attrid');
				var estado	 	  = $(this).attr('attrstatus');
				var of_status, mensaje;
				if(estado == 1){
					of_status = 0;
					mensaje = '¿Deseas eliminar el registro?';
				}
				if(estado == 0){
					of_status = 1;
					mensaje = '¿Deseas activar el registro?';
				}
				$.confirm({
					title: mensaje,
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
						    		url: '<?= base_url(); ?>of_oficinas/cambiar_status_oficina',
						    		data: 'of_id_oficina='+of_id_oficina+'&of_status='+of_status,
						    		dataType: 'json',
						    		success: function(resp){
						    			if(resp == true){
						    				location.href='<?= base_url(); ?>of_oficinas'
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