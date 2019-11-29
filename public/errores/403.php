<html lang="en"
      class="wf-flaticon-n4-inactive wf-opensans-n3-active wf-opensans-n4-active wf-opensans-n6-active wf-opensans-n7-active wf-fontawesome5regular-n4-active wf-fontawesome5solid-n4-active wf-fontawesome5brands-n4-active wf-active">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>404</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport">
    <link rel="icon" href="<?php echo APP_DIR; ?>public/assets/img/icon.ico" type="image/x-icon">

    <!-- Fonts and icons -->
    <script src="<?php echo APP_DIR; ?>public/assets/js/plugin/webfont/webfont.min.js"></script>
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" media="all">
    <link rel="stylesheet" href="<?php echo APP_DIR; ?>public/assets/css/fonts.css" media="all">
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
<body class="page-not-found">
<div class="wrapper not-found">
    <h1 class="">403</h1>
    <div class="desc"><span>OOPS!</span><br>Acceso prohibido</div>
    <a href="index" class="btn btn-primary btn-back-home mt-4">
			<span class="btn-label mr-2">
				<i class="flaticon-home"></i>
			</span>
        Volver al inicio
    </a>
</div>
</body>
</html>