#!/bin/bash

# arepaEngine CLI


# Crear estructura de directorios para un nuevo módulo del sistema
function create_module() { # $1 = modulo
    ruta='../../app/Modulos'
    cd $ruta
 
    if [ ! -d "$1" ]; then
        mkdir $1; cd $1
        mkdir modelo vista controlador
        echo -e "Módulo \033[1m$1\033[22m creado con éxito"
    else
        echo "El módulo $1 ya existe y no puede ser sobreescrito."
        echo "ejecute \"./arepa -d $1\" para eliminarlo"
    fi
}


