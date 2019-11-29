<?php

namespace Core\Menu;

    use Core\Helpers\Consultor as Consultor;

    $menu_sistama = new Menu();

    class Menu
    {
        public function __construct()
        {
            $sql = Consultor\Consultor::Consulta('*', 'sistema_menu', '1=1');

            return $sql;
        }
    }
