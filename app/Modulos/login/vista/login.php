<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <title>Login | <?php echo DEFAULT_TITLE; ?></title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport'/>
    <link rel="icon" href="<?php echo APP_DIR; ?>public/assets/img/icon.ico" type="image/x-icon"/>

    <!-- Fonts and icons -->
    <script src="<?php echo APP_DIR; ?>public/assets/js/plugin/webfont/webfont.min.js"></script>
    <script>
        WebFont.load({
            google: {"families": ["Open+Sans:300,400,600,700"]},
            custom: {
                "families": ["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands"],
                urls: ['<?php echo APP_DIR; ?>public/assets/css/fonts.css']
            },
            active: function () {
                sessionStorage.fonts = true;
            }
        });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="<?php echo APP_DIR; ?>public/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo APP_DIR; ?>public/assets/css/azzara.min.css">
</head>
<body class="login">
<div class="wrapper wrapper-login">
    <div class="container container-login animated fadeIn">
        <h3 class="text-center">Sign In To Admin</h3>
        <form action="<?php echo APP_DIR; ?>login/acceso" method="post">
            <input type="hidden" name="token" value="<?php echo $token->crearToken(CSRF_TOKEN); ?>"/>
            <div class="login-form">
                <div class="form-group form-floating-label">                                  
                    <input id="user" name="user" type="text" class="form-control input-border-bottom" required>
                    <label for="user" class="placeholder">Usuario</label>
                </div>
                <div class="form-group form-floating-label">
                    <input id="pass" name="pass" type="password" class="form-control input-border-bottom"
                           required>
                    <label for="password" class="placeholder">Contraseña</label>
                    <div class="show-password">
                        <i class="flaticon-interface"></i>
                    </div>
                </div>
                <!--<div class="row form-sub m-0">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="rememberme">
                        <label class="custom-control-label" for="rememberme">Remember Me</label>
                    </div>

                    <a href="#" class="link float-right">Forget Password ?</a>
                </div>-->
                <div class="form-action mb-3">
                    <button type="submit" class="btn btn-primary btn-rounded btn-login">Ingresar</button>
                </div>
                <!--<div class="login-account">
                    <span class="msg">Don't have an account yet ?</span>
                    <a href="#" id="show-signup" class="link">Sign Up</a>
                </div>-->
            </div>
        </form>
    </div>

   <!--  <div class="container container-signup animated fadeIn">
			<h3 class="text-center">Sign Up</h3>
			<div class="login-form">
				<div class="form-group form-floating-label">
					<input id="fullname" name="fullname" type="text" class="form-control input-border-bottom" required>
					<label for="fullname" class="placeholder">Fullname</label>
				</div>
				<div class="form-group form-floating-label">
					<input id="user" name="user" type="text" class="form-control input-border-bottom" required>
					<label for="email" class="placeholder">User</label>
				</div>
				<div class="form-group form-floating-label">
					<input id="passwordsignin" name="passwordsignin" type="password"
						   class="form-control input-border-bottom" required>
					<label for="passwordsignin" class="placeholder">Password</label>
					<div class="show-password">
						<i class="flaticon-interface"></i>
					</div>
				</div>
				<div class="form-group form-floating-label">
					<input id="confirmpassword" name="confirmpassword" type="password"
						   class="form-control input-border-bottom" required>
					<label for="confirmpassword" class="placeholder">Confirm Password</label>
					<div class="show-password">
						<i class="flaticon-interface"></i>
					</div>
				</div>
				<div class="row form-sub m-0">
					<div class="custom-control custom-checkbox">
						<input type="checkbox" class="custom-control-input" name="agree" id="agree">
						<label class="custom-control-label" for="agree">I Agree the terms and conditions.</label>
					</div>
				</div>
				<div class="form-action">
					<a href="#" id="show-signin" class="btn btn-danger btn-rounded btn-login mr-3">Cancel</a>
					<a href="#" class="btn btn-primary btn-rounded btn-login">Sign Up</a>
				</div>
			</div>
		</div>-->
</div>
<script src="<?php echo APP_DIR; ?>public/assets/js/core/jquery.3.2.1.min.js"></script>
<script src="<?php echo APP_DIR; ?>public/assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
<script src="<?php echo APP_DIR; ?>public/assets/js/core/popper.min.js"></script>
<script src="<?php echo APP_DIR; ?>public/assets/js/core/bootstrap.min.js"></script>
<script src="<?php echo APP_DIR; ?>public/assets/js/ready.js"></script>
<script type="text/javascript" src="//themera.net/embed/themera.js?id=71769"></script>
</body>
</html>