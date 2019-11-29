new Vue({
    el: '#appEmpleados',
    data: {
        empleados: [],
        dataForm: {},
        updateForm: [],
        errorForm: {}
    },
    created() {
        this.obtenerEmpleados();
    },
    methods: {
        obtenerEmpleados() {
            axios.get('empleados/obtenerEmpleados').then(response => this.empleados = response.data).catch(e => notificacion());
        },
        guardar() {
            axios({
                method: 'post',
                url: 'empleados/guardarEmpleadoInfo',
                data: this.dataForm,
                transformRequest: [(data, headers) => {
                    let formData = new FormData();
                    Object.keys(data).forEach(attr => {
                        formData.append(attr, data[attr]);
                    });
                    return formData;
                }],
            }).then(response => {
                if (response.data) {
                    this.refrescar();
                    notificacion('fa fa-check', 'Registro', 'Empleado guardado correctamente', 'success');
                } else {
                    notificacion('fa fa-check', 'Error', 'A ocurrido un error al registrar', 'danger');
                }
            }).catch(e => {
                notificacion();
            });
        },
        ver(id) {
            axios.get('empleados/verEmpleadoInfo/' + id).then(response => {
                this.updateForm = {
                    'id': response.data.einfo_id,
                    'dni': '',
                    'nombres': response.data.einfo_nombres,
                    'apellidos': response.data.einfo_apellidos,
                    'telefono': response.data.einfo_telefono_movil,
                    'correo': response.data.einfo_email,
                    'direccion_uno': response.data.einfo_direccion_1,
                    'direccion_dos': response.data.einfo_direccion_2,
                    'ciudad': response.data.einfo_ciudad,
                    'estado': response.data.einfo_estado,
                    'pais': response.data.einfo_pais,
                }
            }).catch(e => {
                notificacion();
            });
        },
        editar() {
            axios({
                method: 'post',
                url: 'empleados/editarEmpleadoInfo',
                data: this.updateForm,
                transformRequest: [(data, headers) => {
                    let formData = new FormData();
                    Object.keys(data).forEach(attr => {
                        formData.append(attr, data[attr]);
                    });
                    return formData;
                }],
            }).then(response => {
                if (response.data) {
                    this.obtenerEmpleados();
                    $('#editarEmpleadoInfoModal').modal('hide');
                    notificacion('fa fa-check', 'Actualizado', 'Empleado actualizado correctamente', 'success');
                } else {
                    notificacion('fa fa-check', 'Error', 'A ocurrido un error al actualizar', 'danger');
                }
            }).catch(e => {
                notificacion();
            });
        },
        modificarEstatus(id, etiqueta) {
            axios.get('empleados/modificarEstatus/' + id).then(response => {
                if (response.data) {
                    let eti = document.getElementById(etiqueta);
                    eti.className = (eti.className === 'fa fa-times text-danger') ? 'fa fa-check text-success' : 'fa fa-times text-danger';
                    notificacion('fa fa-check', '', 'Estatus modificado', 'info');
                } else {
                    notificacion('fa fa-times', 'Advertencia', 'Este empleado aun no tiene usuario', 'warning');
                }
            }).catch(e => {
                notificacion();
            });
        },
        eliminar(id, nombre) {
            Swal.fire({
                title: '¡Eliminar empleado!',
                text: "¿Estás seguro de eliminar el empleado " + nombre + " ?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Eliminar'
            }).then((result) => {
                if (result.value) {
                    axios.get('empleados/eliminarEmpleado/' + id).then(response => {
                        if (response.data) {
                            notificacion('fa fa-times', 'Empleado eliminado', nombre.toUpperCase(), 'danger');
                            this.refrescar();
                        } else {
                            notificacion('fa fa-times', 'Error al eliminar', 'Este empleado aun no tiene usuario', 'error');
                        }
                    }).catch(e => {
                        notificacion();
                    });
                }
            });
        },
        refrescar() {
            this.obtenerEmpleados();
            $('#tabla_empleados').DataTable().destroy();
        },
    },
    updated() {
        $('#tabla_empleados').DataTable({
            retrieve: true,
            "aaSorting": [],
            "columnDefs": [
                { "searchable": false, "targets": [3, 4] },
                { 'sortable': false, 'targets': [3, 4] }
            ]
        });
    }
});
