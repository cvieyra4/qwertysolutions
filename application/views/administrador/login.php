<!DOCTYPE html>
<html lang="en" class="no-js">
	<head>
		<title>Quadra Towers | Iniciar Sesión</title>
		<meta charset="utf-8" />
		<!--[if IE]><meta http-equiv='X-UA-Compatible' content="IE=edge,IE=9,IE=8,chrome=1" /><![endif]-->
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
		<link rel="stylesheet" href="<?= plugin_url(); ?>bootstrap-colorpalette/css/bootstrap-colorpalette.css">
		<link rel="stylesheet" href="<?= plugin_url(); ?>perfect-scrollbar/src/perfect-scrollbar.css">
		<link rel="stylesheet" href="<?= css_url(); ?>theme_light.css" type="text/css" id="skin_color">
	</head>
	<body class="login example1">
		<div class="main-login col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
			<div class="logo">MIA OFFICE
			</div>
			<div class="box-login">
				<h3>Inicia sesión con tu cuenta</h3>
				<p>
					Por favor ingresa usuario y contraseña
				</p>
				<form class="form-login" action="<?= base_url(); ?>administrador/iniciar_sesion" method="post" accept-charset="utf-8">
					<fieldset>
						<div class="form-group">
							<span class="input-icon">
								<input type="text" class="form-control" name="us_usuario" placeholder="Usuario" 
								value="<?php echo set_value('us_usuario'); ?>">
								<i class="fa fa-user"></i> </span>
						</div>
						<span class="pull-center " style="color: red; "><?php echo form_error('us_usuario'); ?></span>
						<div class="form-group form-actions">
							<span class="input-icon">
								<input type="password" class="form-control password" name="us_contrasenia" placeholder="Contraseña">
								<i class="fa fa-lock"></i>
								<a class="forgot" href="#">
									Olvide mi contraseña
								</a> </span>
						</div>
						<span class="pull-center " style="color: red; "><?php echo form_error('us_contrasenia'); ?></span>
						<div class="form-actions">
							<button type="submit" class="btn btn-blue pull-right">
								Ingresar <i class="fa fa-arrow-circle-right"></i>
							</button>
						</div>
						<div class="new-account">
							No tienes una cuenta todavia?
							<a href="#" class="register">
								Crear una cuenta
							</a>
						</div>
					</fieldset>
				</form>
			</div>

			<div class="box-forgot">
				<h3>Olvidaste la contraseña?</h3>
				<p>
					Ingresa tu correo para resetear la contraseña.
				</p>
				<form class="form-forgot">
					<fieldset>
						<div class="form-group">
							<span class="input-icon">
								<input type="email" class="form-control" name="us_correo" placeholder="Correo">
								<i class="fa fa-envelope"></i> </span>
						</div>
						<div class="form-actions">
							<a class="btn btn-light-grey go-back">
								<i class="fa fa-circle-arrow-left"></i> Regresar
							</a>
							<button type="button" class="btn btn-green pull-right resetear_contraseña">
								Enviar <i class="fa fa-arrow-circle-right"></i>
							</button>
						</div>
					</fieldset>
				</form>
			</div>

			<div class="box-register">
				<h3>Registro</h3>
				<p>
					Ingresa tus datos personales:
				</p>
				<form class="form-register">
					<fieldset>
						<div class="form-group">
							<input type="text" class="form-control" name="us_nombre" placeholder="Nombre">
						</div>
						<div class="form-group">
							<input type="text" class="form-control" name="us_apellido_paterno" placeholder="Apellido Paterno">
						</div>
						<div class="form-group">
							<input type="text" class="form-control" name="us_apellido_materno" placeholder="Apellido Materno">
						</div>
						<p>
							Ingresa detalles de la cuenta
						</p>
						<div class="form-group">
							<span class="input-icon">
								<input type="email" class="form-control" name="us_correo_nuevo" placeholder="Correo">
								<i class="fa fa-envelope"></i> </span>
						</div>
						<div class="form-group">
							<span class="input-icon">
								<input type="password" class="form-control" id="us_contrasenia_nueva" name="us_contrasenia_nueva" placeholder="Contraseña">
								<i class="fa fa-lock"></i> </span>
						</div>
						<div class="form-group">
							<span class="input-icon">
								<input type="password" class="form-control" name="us_contrasenia_rep" placeholder="Repite Contraseña">
								<i class="fa fa-lock"></i> </span>
						</div>
						<div class="form-actions">
							<a class="btn btn-light-grey go-back">
								<i class="fa fa-circle-arrow-left"></i> Regresar
							</a>
							<button type="submit" class="btn btn-green pull-right">
								Registrarse <i class="fa fa-arrow-circle-right"></i>
							</button>
						</div>
					</fieldset>
				</form>
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
		<script src="<?= plugin_url(); ?>jquery-validation/dist/jquery.validate.min.js"></script>
	</body>
</html>