function notificacion(icono = 'fa fa-times', titulo = 'error', mensaje = 'Lo sentimos ha ocurrido un error porfavor intentelo de nuevo más tarde', tipo = 'danger') {
    $.notify({
        icon: icono,
        title: titulo,
        message: mensaje,
    }, {
        element: 'body',
        position: null,
        type: tipo,
        z_index: 4000,
    });
}