#!/bin/bash

# arepaEngine CLI
# @package    arepaEngine
# @subpackage core.cli
# @license    http://www.gnu.org/licenses/gpl.txt  GNU GPL 3.0
# @author     Eugenia Bahit <ebahit@member.fsf.org>
# @link       http://www.arepa.org


# Genera el código para un modelo
function set_model() {
    filename=`php -r "print ucfirst('$1');"`
    property=$filename
    contenido=`replace ClassName $1 property $property < templates/model`
    echo "$contenido" > ../../app/Modulos/$2/modelo/$filename.php
}


# Genera el código para un controlador
function set_controller() {
    filename=`php -r "print ucfirst('$1');"`
    property=$filename
    contenido=`replace MODULO $2 ARCHIVO $filename ClassName $1 property \
        $property < templates/controller`
    echo "$contenido" > ../../app/Modulos/$2/controlador/$filename'Controlador'.php
}


# Genera el código para una vista
function set_view() {
        echo "" > ../../app/Modulos/$2/vista/index.php
        echo "" > ../../app/Modulos/$2/vista/crear.php
        echo "" > ../../app/Modulos/$2/vista/ver.php
        echo "" > ../../app/Modulos/$2/vista/editar.php
}

# Crear los archivos models, views y controllers
function create_files() {
        set_model $2 $1
        set_controller $2 $1
        set_view $2 $1
        composer dump-autoload -o
        echo "Listo!"

}
