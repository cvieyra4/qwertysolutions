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
						<div class="col-md-12">
							<form action="" method="POST" id="card-form">
							  <span class="card-errors"></span>
							  <div>
							    <label>
							      <span>Nombre del tarjetahabiente</span>
							      <input type="text" size="20" data-conekta="card[name]">
							    </label>
							  </div>
							  <div>
							    <label>
							      <span>Número de tarjeta de crédito</span>
							      <input type="text" size="20" data-conekta="card[number]">
							    </label>
							  </div>
							  <div>
							    <label>
							      <span>CVC</span>
							      <input type="text" size="4" data-conekta="card[cvc]">
							    </label>
							  </div>
							  <div>
							    <label>
							      <span>Fecha de expiración (MM/AAAA)</span>
							      <input type="text" size="2" data-conekta="card[exp_month]">
							    </label>
							    <span>/</span>
							    <input type="text" size="4" data-conekta="card[exp_year]">
							  </div>
							  <button class="btn btn-success" type="submit">Crear token</button>
							</form>
						</div>
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
		<script type="text/javascript" src="https://cdn.conekta.io/js/latest/conekta.js"></script>
		<script>
			jQuery(document).ready(function() {
				Main.init();
				Index.init();
				$.stellar();
			});
		</script>
		<script type="text/javascript" >
		  Conekta.setPublicKey('key_Ay6gKyoXc3yEzX24zyJr7QQ');

		  var conektaSuccessResponseHandler = function(token) {
		    var $form = $("#card-form");
		    //Inserta el token_id en la forma para que se envíe al servidor
		     $form.append($('<input type="hidden" name="conektaTokenId" id="conektaTokenId">').val(token.id));
		    $form.get(0).submit(); //Hace submit
		  };
		  var conektaErrorResponseHandler = function(response) {
		    var $form = $("#card-form");
		    $form.find(".card-errors").text(response.message_to_purchaser);
		    $form.find("button").prop("disabled", false);
		  };

		  //jQuery para que genere el token después de dar click en submit
		  $(function () {
		    $("#card-form").submit(function(event) {
		      var $form = $(this);
		      // Previene hacer submit más de una vez
		      $form.find("button").prop("disabled", true);
		      Conekta.Token.create($form, conektaSuccessResponseHandler, conektaErrorResponseHandler);
		      return false;
		    });
		  });
		</script>
		</script>
	</body>
</html>
