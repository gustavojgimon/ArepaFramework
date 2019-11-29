<form action="#" autocomplete="off" @submit.prevent="editar">
    <div class="modal fade" id="editarEmpleadoInfoModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Editar empleado</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-row">
                        <div class="col">
                            <div class="form-group">
                                <label for="nombres">Nombres:</label>
                                <input type="text" id="nombres" class="form-control" v-model="updateForm.nombres">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="apellidos">Apellidos:</label>
                                <input type="text" id="apellidos" class="form-control" v-model="updateForm.apellidos">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col">
                            <div class="form-group">
                                <label for="telefono">Telefono:</label>
                                <input type="tel" id="telefono" class="form-control" v-model="updateForm.telefono">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="correo">Correo electronico:</label>
                                <input type="text" id="correo" class="form-control" v-model="updateForm.correo">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="direccion_uno">Direccion:</label>
                        <input type="text" id="direccion_uno" class="form-control" v-model="updateForm.direccion_uno">
                    </div>
                    <div class="form-group">
                        <label for="direccion_dos">Referencia:</label>
                        <input type="text" id="direccion_dos" class="form-control" v-model="updateForm.direccion_dos">
                    </div>
                    <div class="form-row">
                        <div class="col">
                            <div class="form-group">
                                <label for="ciudad">Ciudad:</label>
                                <input type="text" id="ciudad" class="form-control" v-model="updateForm.ciudad">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="estado">Estado:</label>
                                <input type="text" id="estado" class="form-control" v-model="updateForm.estado">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="pais">Pais:</label>
                                <input type="text" id="pais" class="form-control" v-model="updateForm.pais">
                            </div>
                        </div>
                    </div>
                    <div class="alert alert-warning" v-for="row in errorForm">{{ row }}</div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-round btn-sm" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary btn-round btn-sm">Actualizar</button>
                </div>
            </div>
        </div>
    </div>
</form>