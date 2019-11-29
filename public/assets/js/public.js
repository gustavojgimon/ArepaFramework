axios.defaults.headers = {
    'X-Requested-With': 'XMLHttpRequest'
};

function notificacion(icono = 'fa fa-times', titulo = 'error', mensaje = 'Lo siento ha ocurrido error intentolo de nuevo mas tarde', tipo = 'danger') {

}

var app = new Vue({
    el: '#app-login',
    data: {
        dataForm: {},
        errorForm: {}
    },http    :   {
        headers: {
            'X-CSRF-Token': $('meta[name=token]').attr('content')
        }
    },
    methods: {
        formLogin() {
            axios(
                {
                    method: 'post',
                    url: 'auth/acceso',
                    data: this.dataForm,
                    transformRequest: [(data, headers) => {
                        let formData = new FormData();
                        Object.keys(data).forEach(attr => {
                            formData.append(attr, data[attr]);
                        });
                        return formData;
                    }]
                }
            )
                .then(response => {
                    if (response.logged_in == true) {

                        window.location.href = '/';

                        $('#form-login button[type=submit]').html(cargando);
                        $('#boton_submit').addClass('btn btn-success');
                        $('#form-login button[type=submit]').attr('disabled', 'disabled');

                    } else if (response.logged_in == false) {
                        alert('Usuario o clave incorrectos');
                        $('#form-login button[type=submit]').html('Ingresar');
                        $('#boton_submit').addClass('btn btn-danger');
                        $('#form-login button[type=submit]').attr('disabled', 'disabled');
                    } else {
                        $('#form-login button[type=submit]').html('Error al intentar loguear');

                    }
                })
                .catch(e => {
                    console.log(e);
                    notificacion();
                });
        }
    }
});


$('#form-login').submit(function (e) {
    e.preventDefault();
    let form = $('#form-login').serialize();

    $.ajax({
            type: 'POST',
            url: 'auth/acceso',
            data: form,
            dateType: 'json',
            beforeSend: function () {
                $('#form-login button[type=submit]').html(cargando);
                $('#form-login button[type=submit]').attr('disabled', 'disabled');
            },

            success: function (response) {
                console.log(response.logged_in);
                if (response.logged_in == true) {

                    window.location.href = '/';

                    $('#form-login button[type=submit]').html(cargando);
                    $('#boton_submit').addClass('btn btn-success');
                    $('#form-login button[type=submit]').attr('disabled', 'disabled');

                } else if (response.logged_in == false) {
                    alert('Usuario o clave incorrectos');
                    $('#form-login button[type=submit]').html('Ingresar');
                    $('#boton_submit').addClass('btn btn-danger');
                    $('#form-login button[type=submit]').attr('disabled', 'disabled');
                } else {
                    $('#form-login button[type=submit]').html('Error al intentar loguear');

                }
            },
        }
    );
});

/** funcion para enviar post **/

$('.form-submit').submit(function (e) {
    e.preventDefault();
    let data = $('.form-submit');
    let form = data.serialize();
    let url = data.attr('action');
    let method = data.attr('method');
    $.ajax({
        type: method,
        url: url,
        dataType: 'json',
        data: form,
    }).done(function (response, textStatus, jqXHR) {
        if (response.saved === true) {
            $('.form-submit button[type=submit]').addClass('btn btn-info');
            toastr.success('Operación realizada exitosamente', 'Exito');
            if (response.redirect !== undefined) {
                window.location = response.redirect;
            }

        } else if (response.saved === false) {
            toastr.error('Ups, error en la operación', 'Error');
            $('.form-submit button[type=submit]').addClass('btn btn-danger');
        } else if (response.saved === 'error') {
            let obj = JSON.stringify(response);
            let jsonData = JSON.parse(obj);
            console.log(jsonData);
            $('#errors').empty();
            for (let obj in jsonData) {
                if (jsonData.hasOwnProperty(obj)) {
                    for (let prop in jsonData[obj]) {
                        if (jsonData[obj].hasOwnProperty(prop)) {
                            if (isNaN(prop)) {
                                let errors = jsonData[obj][prop];
                                $('#errors').append("<div class='alert alert-danger'> " + errors + "  </div>");
                                $.toast({
                                    position: 'top-right',
                                    heading: prop,
                                    text: jsonData[obj][prop],
                                    icon: 'error',
                                    loader: true,        // Change it to false to disable loader
                                    loaderBg: '#9EC600'  // To change the background
                                });
                            }
                        }
                    }
                }
            }
        }
    }).fail(function (jqXHR, textStatus, errorThrown) {
        if (console && console.log) {
            console.log("La solicitud a fallado: " + textStatus);
        }
    }).always(function () {
        if (console && console.log) {
            console.log("ajax ejecutado");
        }
    });
});

var cargando = '<div class="m-loader m-loader--brand" style="width: 30px; display: inline-block;"></div>';
