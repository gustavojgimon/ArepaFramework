<?php

    session_start();
    require_once 'configuracion.php';
    require_once __DIR__.'/vendor/autoload.php';
    Core\FrontController\FrontController::inicio();
?>

