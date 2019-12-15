#!/bin/bash

function install_command() {
    echo "ESTA ACCIÓN INSTALARÁ EL COMANDO <arepa> EN EL DIRECTORIO /USR/BIN"
    echo "DEBERÁ TENER LA CLAVE DE ADMINISTRACIÓN PARA COMPLETAR LA TAREA"

    sudo cp bin/arepa /usr/bin/arepa
    sudo chmod +x /usr/bin/arepa
    echo "Done."
}
