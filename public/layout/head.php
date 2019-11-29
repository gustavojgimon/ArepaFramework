<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <meta name="token" content="<?php echo $token->crearToken(CSRF_TOKEN); ?>">

    <title><?php echo DEFAULT_TITLE; ?></title>
    <link rel="icon" href="<?= APP_DIR; ?>public/assets/img/icon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="<?= APP_DIR; ?>public/assets/fontawesome-free-5.11.2-web/css/all.min.css">
    <link rel="stylesheet" href="<?= APP_DIR; ?>public/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= APP_DIR; ?>public/assets/css/azzara.min.css">
    <script src="<?= APP_DIR; ?>public/assets/vue.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue-resource@1.5.1"></script>
    <script src="<?= APP_DIR; ?>public/assets/axios.min.js"></script>
    <script src="<?= APP_DIR; ?>public/assets/js/core/jquery.3.2.1.min.js"></script>
    <style>
        [v-cloak]>* {
            display: none
        }
    </style>
    <script>
        axios.defaults.baseURL = '<?php echo APP_DIR; ?>';
        axios.defaults.timeout = 20000;
        axios.defaults.headers = {
            'X-Requested-With': 'XMLHttpRequest',
        };
    </script>
</head>

<body>
    <div class="wrapper">