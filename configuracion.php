<?php

/**
 * Constantes de configuración personalizada.
 *
 * @author; Gustavo J' Gimon' <gustavojgimon@gmail.com>
 *
 * @version asdas
 */
/* ==============================================================================
  CONSTANTES
  ================================================================================ */
$config_file = 'config.ini';
$options = parse_ini_file($config_file, true);
foreach ($options as $section => $config) {
    foreach ($config as $constant => $value) {
        define($constant, $value);
    }
}
// ==============================================================================
//                           CONFIGURACIÓN DE PHP
// ==============================================================================
ini_set('include_path', APP_DIR);
ini_set('session.gc_maxlifetime', SESSION_LIFE_TIME);
ini_set('session.cookie_lifetime', SESSION_LIFE_TIME);

// ==============================================================================
//                           CONFIGURACIÓN DE ENTORNO DESARROLLO/PRODUCCION/MANTENIMIENTO
// ==============================================================================
switch (ENTORNO) {
    case 'desarrollo':
        error_reporting(-1);
        ini_set('display_errors', 1);
        break;
    case 'testing':
    case 'produccion':
        ini_set('display_errors', 0);
        if (version_compare(PHP_VERSION, '5.3', '>=')) {
            error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_STRICT & ~E_USER_NOTICE & ~E_USER_DEPRECATED);
        } else {
            error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_USER_NOTICE);
        }
        break;
    default:
        header('HTTP/1.1 503 Service Unavailable.', true, 503);
        echo 'The application environment is not set correctly.';
        exit(1); // EXIT_ERROR
}
