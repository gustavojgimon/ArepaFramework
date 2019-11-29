<div class="card" id="appEmpleados" v-cloak>
    <div class="card-header">
        <div class="card-head-row">
            <div class="card-title">Lista de empleados</div>
            <div class="card-tools">
                <a href="#" class="btn btn-default btn-round btn-sm mr-2" data-toggle="modal" data-target="#guardarEmpleadoInfoModal">
                    <span class="btn-label">
                        <i class="fa fa-user-plus"></i>
                    </span>
                    Guardar
                </a>
            </div>
        </div>
    </div>
    <div class="table-responsive mt-3">
        <table class="table table-striped table-hover" id="tabla_empleados">
            <thead>
            <tr class="border-0">
                <th class="border-0">Nombre y apellidos</th>
                <th class="border-0">Telefono</th>
                <th class="border-0">Correo</th>
                <th class="border-0"></th>
                <th class="border-0"></th>
            </tr>
            </thead>
            <tbody>
            <tr v-if="empleados.length ==0" class="table-warning">
                <td colspan="8" align="center"><b>Sin datos</b></td>
            </tr>
            <tr v-for="row in empleados">
                
                <td><a :href="'<?= APP_DIR; ?>empleados/ver/' +  row.einfo_id">{{ row.einfo_nombres }} {{ row.einfo_apellidos }}</a></td>
                <td>{{ row.einfo_telefono_movil }}</td>
                <td>{{ row.einfo_email }}</td>
                <td class="text-center">
                    <a href="#" title="Modificar estatus" @click.prevent="modificarEstatus(row.einfo_id, 'status'+row.einfo_id)">
                        <i :class="row.emp_estatus == 1 ? 'fa fa-check text-success' : 'fa fa-times text-danger'" :id="'status'+row.einfo_id"></i>
                    </a>
                </td>
                <td class="text-center">
                    <a href="#" title="Editar" data-toggle="modal" data-target="#editarEmpleadoInfoModal" @click.prevent="ver(row.einfo_id)"><i class="fa fa-edit"></i></a>
                    <a href="#" title="Eliminar" @click.prevent="eliminar(row.einfo_id, row.einfo_nombres)">
                        <i class="fa fa-trash text-danger"></i>
                    </a>
                </td>
            </tr>
            </tbody>
            <tfoot>
            <tr class="border-0">
                <th class="border-0">Nombre y apellidos</th>
                <th class="border-0">Telefono</th>
                <th class="border-0">Correo</th>
                <th class="border-0"></th>
                <th class="border-0"></th>
            </tr>
            </tfoot>
        </table>
    </div>
	<?php include 'modalguardarempleadoinfo.php'; ?>
	<?php include 'modaleditarempleadoinfo.php'; ?>
</div>
<script src="<?= APP_DIR; ?>public/assetsvuejs/empleados/empleados.js"></script>