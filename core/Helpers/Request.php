<?php

namespace Core\Helpers;

    class Request
    {
        public function __construct()
        {
            if ($_POST) {
                foreach ($_POST as $key => $valor) {
                    ${$key} = $valor.'<br>';
                }
            }
        }
    }
