<?php

/**
 * Created by PhpStorm.
 * User: gustavojgimon
 * Date: 2/3/19
 * Time: 11:58 AM.
 */

namespace Core\Librerias;

    use CodeIgniter\Controller;

    class Template extends Controller
    {
        private static $sys_data = [];

        public function loads($vista = 'home/home', $data = null)
        {
            if (isset($data) && null !== $data) {
                self::$sys_data = $data;
                echo view('partials/head', self::$sys_data);
            } else {
                echo view('partials/head');
            }

            echo view('partials/header');
            echo view('partials/sidebar');
            echo view('partials/header_module');
            echo view($vista);
            echo view('partials/footer');
        }

        public function load($vista = 'home/home', $data = null)
        {
            if (isset($data) && null !== $data) {
                self::$sys_data = $data;
                echo view('partials/head', self::$sys_data);
            } else {
                echo view('partials/head');
            }
            echo view('partials/header');
            echo view('partials/sidebar');
            echo view($vista);
            echo view('partials/footer');
        }
    }
