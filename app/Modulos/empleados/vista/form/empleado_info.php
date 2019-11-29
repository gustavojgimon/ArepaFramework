<div class="card-body">
    <div class="modal-body">
        <div class="form-row">
            <div class="col">
                <div class="form-group">
                    <label for="einfo_nombres">Nombres:</label>
                    <input type="text" id="einfo_nombres" name="einfo_nombres" class="form-control" value="<?php echo $empleado->einfo_apellidos; ?>">
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="apellidos">Apellidos:</label>
                    <input type="text" id="einfo_apellidos" name="einfo_apellidos" class="form-control" value="<?php echo $empleado->einfo_apellidos; ?>">
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="col">
                <div class="form-group">
                    <label for="telefono">Telefono:</label>
                    <input type="tel" id="einfo_telefono_movil" name="einfo_telefono_movil" class="form-control" value="<?php echo $empleado->einfo_telefono_movil; ?>">
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="correo">Correo electronico:</label>
                    <input type="text" id="einfo_email" name="einfo_email" class="form-control" value="<?php echo $empleado->einfo_email; ?>">
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="direccion_uno">Direccion:</label>
            <input type="text" id="einfo_direccion_1" name="einfo_direccion_1" class="form-control" value="<?php echo $empleado->einfo_direccion_1; ?>">
        </div>
        <div class="form-group">
            <label for="direccion_dos">Referencia:</label>
            <input type="text" id="einfo_direccion_2" name="einfo_direccion_2" class="form-control" value="<?php echo $empleado->einfo_direccion_1; ?>">
        </div>
        <div class="form-row">
            <div class="col">
                <div class="form-group">
                    <label for="ciudad">Ciudad:</label>
                    <input type="text" id="einfo_ciudad" name="einfo_ciudad" class="form-control" value="<?php echo $empleado->einfo_ciudad; ?>">
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="estado">Estado:</label>
                    <input type="text" id="einfo_estado" name="einfo_estado" class="form-control"value="<?php echo $empleado->einfo_estado; ?>">
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="pais">Pais:</label>
                    <input type="text" id="einfo_pais" name="einfo_pais" class="form-control" value="<?php echo $empleado->einfo_pais; ?>">
                </div>
            </div>
        </div>
        <div class="alert alert-warning" v-for="row in errorForm">{{ row }}</div>
    </div>
</div>